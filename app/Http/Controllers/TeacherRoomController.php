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
use Illuminate\Support\Facades\DB;

class TeacherRoomController extends Controller
{
    public function index()
    {
        $teacher = Professor::first();
        return view('teacher.index')->with('teacher', $teacher);
    }

    public function changedata(Request $request)
    {
        $currentid = $request->input('id');
        $surname = $request->input('Surname');
        $name = $request->input('Name');
        $patronymic = $request->input('Patronymic');
        DB::table('professors')
            ->where('ProfessorId', $currentid)
            ->update(['Surname' => $surname], ['Name' =>  $name], ['Patronymic' =>  $patronymic]);
        $teacher = Professor::first();
        return view('teacher.index')->with('teacher', $teacher);
    }
}