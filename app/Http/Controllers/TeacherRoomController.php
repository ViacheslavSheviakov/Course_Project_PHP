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
use Illuminate\Support\Facades\Auth;

class TeacherRoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $view = redirect()->route('welcome');

        if ($user != null)
        {
            $teacher = Professor::where('ProfessorId', $user->id)->first();
            $view = view('teacher.index')->with('teacher', $teacher);
        }

        return $view;
    }

    public function changedata(Request $request)
    {
        $teacher = new Professor();
        $currentid = $request->id;
        $teacher->Surname=$request->Surname;
        $teacher->Name=$request->Name;
        $teacher->Patronymic=$request->Patronymic;
        Professor::where('ProfessorId', $currentid)
            ->update($teacher);

        $teacher = Professor::all()->first();
        return view('teacher.index')->with('teacher', $teacher);
    }
}
