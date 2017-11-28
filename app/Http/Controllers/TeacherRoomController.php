<?php

namespace App\Http\Controllers;


use App\Grade;
use App\Group;
use App\Professor;
use App\Schedule;
use App\Student;
use App\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherRoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $view = redirect()->route('welcome');

        if ($user != null) {
            $professorSchedule = DB::table('professors')
                ->join('teaching', 'professors.ProfessorId', '=', 'teaching.ProfessorId')
                ->join('schedule', 'teaching.TeachingId', '=', 'schedule.TeachingId')
                ->where('professors.professorId', '=', $user->id)
                ->select('professors.professorId', 'teaching.SubjectShortTitle', 'schedule.scheduleId', 'schedule.LessonType', 'schedule.lessonDate', 'schedule.lessonNumber')
                ->get();

            $teacher = Professor::where('ProfessorId', $user->id)->first();
            $view = view('teacher.index')->with(['teacher' => $teacher, 'professorSchedule' => $professorSchedule]);


//            SELECT * FROM professors
//            JOIN teaching ON professors.ProfessorId = teaching.ProfessorId
//            JOIN schedule ON teaching.TeachingId = schedule.TeachingId
//            WHERE professors.ProfessorId=6
        }

        return $view;
    }

    public function changedata(Request $request)
    {
        $teacher = new Professor();
        $currentid = $request->id;
        $teacher->Surname = $request->Surname;
        $teacher->Name = $request->Name;
        $teacher->Patronymic = $request->Patronymic;
        Professor::where('ProfessorId', $currentid)
            ->update($teacher);

        $teacher = Professor::all()->first();
        return view('teacher.index')->with('teacher', $teacher);
    }

    public function grades(Request $request)
    {
        $scheduleid=2;
        $grades = Grade::all()->where('ScheduleId',$scheduleid);
        $group = Schedule::all()->where('ScheduleId', $scheduleid)->pluck('GroupShortTitle')->first();
        $date = Schedule::all()->where('ScheduleId', $scheduleid)->pluck('LessonDate')->first();
        $students= Student::all()->where('GroupShortTitle',$group);
        $schedule = Schedule::all()->where('ScheduleId', $scheduleid)->first();

        $professor=$schedule->group->professor;

//        $isGrade = Grade::all()->where('ScheduleId',2)->where('RecordBookId',3)->first();
//        dump($isGrade->GradeId);


        return view('teacher.grades')->with(['students'=> $students,'group'=>$group,'date'=>$date,'professor'=>$professor,'grades'=>$grades,'scheduleid'=>$scheduleid]);
    }

    public function ajaxgrades(Request $request)
    {
        $isGrade = Grade::all()->where('ScheduleId',$request->ScheduleId)->where('RecordBookId',$request->RecordBookId)->first();

        if($isGrade==null)
        {
            $gradeApply = new Grade();
            $gradeApply->RecordBookId = $request->RecordBookId;
            $gradeApply->ScheduleId = $request->ScheduleId;
            $gradeApply->Grade = $request->Grade;
            $gradeApply->save();
        }
        else
            {
                Grade::where('GradeId',$isGrade->GradeId)->update(['Grade'=>$request->Grade]);

        }
    }
}

