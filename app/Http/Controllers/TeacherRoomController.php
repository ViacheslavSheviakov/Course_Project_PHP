<?php
/**
 * Created by PhpStorm.
 * User: Vladimir
 * Date: 11.11.2017
 * Time: 14:14
 */

namespace App\Http\Controllers;


use App\Professor;
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

            dump($professorSchedule);


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
}
