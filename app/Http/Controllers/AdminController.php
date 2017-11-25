<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
}
