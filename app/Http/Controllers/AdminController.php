<?php

namespace App\Http\Controllers;

use App\Group;
use App\Professor;
use App\Role;
use App\Schedule;
use App\Subject;
use App\Teaching;
use App\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Zend\Stdlib\Response;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function editProfessor()
    {
        $teachers = Professor::all();

        return view('teacher.edit')->with('teachers', $teachers);
    }

    public function addProfessor()
    {
        return view('teacher.add');
    }

    public function addProfessorPost(Request $request)
    {
        $timeNow = Carbon::now('Asia/Dhaka')->toDateString();
        if ($request->Surname != "" && $request->Name != "" && $request->Patronymic != "") {
            $credentials = [];
            $credentials['name'] = $request->Surname . ' ' . $request->Name;
            $credentials['email'] = $request->Email;
            $credentials['password'] = 'teacher';

            User::create($credentials);
            $user = User::all()->where('email', $request->Email)->first();
            $user->roles()->attach(Role::all()->where('name', 'Professor')->first()->id);

            $professor = new Professor();
            $professor->ProfessorId = $user->id;
            $professor->Surname = $request->Surname;
            $professor->Name = $request->Name;
            $professor->Patronymic = $request->Patronymic;
            $professor->save();
        } else {
            return redirect()->route('profadd');
        }

        return view('teacher.edit')->with('teachers', Professor::all());
    }

    public function delProfessor($id)
    {
        Professor::where('ProfessorId', '=', $id)->delete();
        User::where('id', '=', $id)->delete();

        return $this->editProfessor();
    }

    public function editPersonalData()
    {
        $view = view('welcome');
        $user = Auth::user();

        if ($user != null) {
            $view = view('admin.change');
        }

        return $view;
    }

    public function editPersonalDataPost(Request $request)
    {
        $view = redirect()->route('home');
        $user = Auth::user();

        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'pass' => 'min:6|required',
            'pass-conf' => 'min:6|same:pass'
        ]);

        if ($validate->fails()) {
            $view = view('admin.change')->with('errors', $validate->errors());
        }

        $user->email = $request->input('email');
        $user->password = $request->input('pass');
        $user->save();

        return $view;
    }

    public function addScheduleStepOne()
    {
        $professors = Professor::all();

        return view('admin.schedule-step-1')->with('professors', $professors);
    }

    public function addScheduleStepTwo(Request $request)
    {
        $professor = Professor::where('ProfessorId', '=', $request->input('id'))->first();

        return view('admin.schedule-step-2')->with('professor', $professor);
    }

    public function addScheduleStepTwoPost(Request $request, $id)
    {
        Schedule::all()->where('ScheduleId', '=', $id)->first()->delete();
        $professor = Professor::where('ProfessorId', '=', $request->input('id'))->first();

        return view('admin.schedule-step-2')->with('professor', $professor);
    }

    public function addScheduleStepSave(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'date' => 'required',
            'subj' => 'required',
            'type' => 'required',
            'group' => 'required',
            'lesson-number' => 'required'
        ]);

        if (!$validate->fails()) {
            $schedule = new Schedule();
            $schedule->LessonDate = $request->input('date');
            $schedule->TeachingId = Teaching::all()->where('ProfessorId', $request->input('id'))->where('SubjectShortTitle', $request->input('subj'))->first()->TeachingId;
            $schedule->LessonType = $request->input('type');
            $schedule->GroupShortTitle = $request->input('group');
            $schedule->LessonNumber = $request->input('lesson-number');
            $schedule->save();
        }

        $professor = Professor::where('ProfessorId', '=', $request->input('id'))->first();

        return view('admin.schedule-step-2')->with('professor', $professor);
    }

    public function addScheduleStepGenerate(Request $request)
    {
        $professor = Professor::where('ProfessorId', '=', $request->input('id'))->first();

        $validate = Validator::make($request->all(), [
            'teach' => 'required',
            'type' => 'required',
            'group' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->route('schedule-step-2');
        }

        $subject = Teaching::find($request->input('teach'))->subject;

        $credits = DB::table('teaching')
            ->select('Credits')
            ->join('subjects', 'subjects.SubjectShortTitle', '=', 'teaching.SubjectShortTitle')
            ->where('teaching.TeachingId', '=', $request->input('teach'))
            ->get()
            ->first()
            ->Credits;

        $routine = [];
        $insertions = 0;
        $type = $request->input('type');

        switch ($type) {
            case 'ЛК': {
                $insertions = $credits * 3;
                break;
            }
            case 'ПЗ': {
                $insertions = $credits * 2 - 1;
                break;
            }
            case 'ЛБ': {
                $insertions = $credits;
                break;
            }
            case 'КОНС': {
                $insertions = $credits;
                break;
            }
            default: {
                $insertions = 1;
            }
        }

        $date = date('Y-m-d', mktime(0, 0, 0, 9, 1, date('Y')));
        $date = new DateTime($date);
        $num = 1;

        while ($insertions > 0) {
            if ($date->format('w') == 0) {
                $date->add(new \DateInterval('P1D'));
                continue;
            }

            $collisionP = DB::table('schedule')
                ->select('*')
                ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
                ->where('ProfessorId', '=', $request->input('id'))
                ->whereDate('LessonDate', '=', $date->format('Y-m-d'))
                ->where('LessonNumber', '=', $num)
                ->first();

            $collisionS = DB::table('schedule')
                ->select('*')
                ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
                ->where('GroupShortTitle', '=', $request->input('group'))
                ->whereDate('LessonDate', '=', $date->format('Y-m-d'))
                ->where('LessonNumber', '=', $num)
                ->first();

            if ($collisionP != null || $collisionS != null)
            {
                if ($num < 5)
                {
                    $num++;
                    continue;
                }

                $num = 1;
                $date->add(new \DateInterval('P1D'));
                continue;
            }

            array_push($routine, [
                'date' => $date->format('Y-m-d'),
                'number' => $num
            ]);

            $date->add(new \DateInterval('P7D'));
            $insertions--;
            $num = 1;
        }

        foreach ($routine as $lesson)
        {
            $schedule = new Schedule();
            $schedule->LessonDate = $lesson['date'];
            $schedule->TeachingId = $request->input('teach');
            $schedule->LessonType = $request->input('type');
            $schedule->GroupShortTitle = $request->input('group');
            $schedule->LessonNumber = $lesson['number'];
            $schedule->save();
        }

        return view('admin.schedule-step-2')->with('professor', $professor);
    }

    public function process(Request $request)
    {
        $teachers = DB::table('professors');
        $statement = 'LIKE';
        $order = $request->input('order');

        $tmp = [
            'ProfessorId' => $request->input('id'),
            'Surname' => $request->input('surname'),
            'Name' => $request->input('name'),
            'Patronymic' => $request->input('patronymic')
        ];

        if ($request->input('p-type') == 'search') {
            $statement = '=';
        }

        foreach ($tmp as $fieldInDB => $fieldInRequest) {
            if ($fieldInRequest != null) {
                $criteria = $fieldInRequest;

                if ($statement == 'LIKE') {
                    $criteria = '%' . $criteria . '%';
                }

                $teachers->where($fieldInDB, $statement, $criteria);
            }
        }

        if ($request->input('s-type') != null) {
            foreach ($request->input('s-type') as $criteria) {
                $teachers->orderBy($criteria, $order);
            }
        }

        $teachers = $teachers->get();

        return view('teacher.edit')->with('teachers', $teachers);
    }

    public function clear(Request $request)
    {
        $collisionP = DB::table('schedule')
            ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
            ->where('ProfessorId', '=', $request->input('id'))
            ->delete();

        $professor = Professor::where('ProfessorId', '=', $request->input('id'))->first();

        return view('admin.schedule-step-2')->with('professor', $professor);
    }

    public function professorSubjects($id)
    {
        $professor = Professor::where('ProfessorId', '=', $id)->first();
        $teachings = Teaching::where('ProfessorId', '=', $id)->get();
        $subjects = Subject::whereNotIn('SubjectShortTitle', function($query) use ($id){
                $query->select('SubjectShortTitle')
                    ->from('teaching')
                    ->where('ProfessorId', '=', $id);
            })->get();

        return view('admin.professor-subjects')->with([
            'professor' => $professor,
            'teachings' => $teachings,
            'subjects' => $subjects
        ]);
    }

    public function professorSubjectDelete($pId, $id)
    {
        Teaching::where('TeachingId', '=', $id)->delete();

        return redirect()->route('professor.subjects', [$pId]);
    }

    public function professorSubjectAdd(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'professor-id' => 'required',
            'new-subject' => 'required'
        ]);

        if (!$validate->fails())
        {
            $teaching = new Teaching();
            $teaching->ProfessorId = $request->input('professor-id');
            $teaching->SubjectShortTitle = $request->input('new-subject');
            $teaching->save();
        }

        return redirect()->route('professor.subjects', [$request->input('professor-id')]);
    }
}
