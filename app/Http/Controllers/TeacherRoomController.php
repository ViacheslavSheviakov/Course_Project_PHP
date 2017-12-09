<?php
/**
 * Created by PhpStorm.
 * User: Vladimir
 * Date: 11.11.2017
 * Time: 14:14
 */

namespace App\Http\Controllers;


use App\Professor;
use Illuminate\Http\Request;

class TeacherRoomController extends Controller
{
    public function index()
    {
        $teacher = Professor::first();
        return view('teacher.index')->with('teacher', $teacher);
    }

    public function changedata(Request $request)
    {
        $teacher = new Professor();
        $currentid = $request->id;
        $teacher->Surname=$request->Surname;
        $teacher->Name=$request->Name;
        $teacher->Patronymic=$request->Patronymic;
        Professor::where('ProfessorId', $currentid)
            ->update(['Surname' =>  $teacher->Surname], ['Name' =>  $teacher->Name], ['Patronymic' => $teacher->Patronymic]);
        $teacher = Professor::first();
        return view('teacher.index')->with('teacher', $teacher);
    }
    public function schedule()
    {
        return view('teacher.schedule');
    }

}
