<?php

namespace App\Http\Controllers;

use App\Role;
use App\Student;
use App\Group;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class StudentEditorController extends Controller
{

    public function index()
    {
        $students = Student::all();
        $groups = Group::all();
        //dump($subjects);
        return view('studenteditor.index')->with(['students'=> $students,'groups'=>$groups]);
    }

    public function add()
    {
        $groups = Group::all();
        return view('studenteditor.add')->with('groups', $groups);
    }

    public function added(Request $request)
    {
        $groups = Group::all();
        $timeNow = Carbon::now('Asia/Dhaka')->toDateString();
        if ($request->Surname != "" && $request->Name != "" && $request->Patronymic != "" && $request->GroupShortTitle != "")
        {
            $credentials = [];
            $credentials['name'] = $request->Surname . ' ' . $request->Name;
            $credentials['email'] = $request->Email;
            $credentials['password'] = '123456';

            User::create($credentials);
            $user = User::all()->where('email', $request->Email)->first();
            $user->roles()->attach(Role::all()->where('name', 'Student')->first()->id);

            $student = new Student();
            $student->RecordBookId = $user->id;
            $student->Surname = $request->Surname;
            $student->Name = $request->Name;
            $student->Patronymic = $request->Patronymic;
            $student->GroupShortTitle = $request->GroupShortTitle;
            $student->EnteringDate = $timeNow;
            $student->save();
        }
        else
        {
            return redirect()->route('studentEditorAdd');
        }
        $students = Student::all();

        return view('studenteditor.index')->with([
            'students'=> $students,'groups'=>$groups]);
    }


    public function del($id)
    {
        Student::where('RecordBookId', '=', $id)->delete();
        User::where('id', '=', $id)->delete();

        return redirect()->route('studentEditor')->with('flash_message', 'User successfully deleted.');
    }

    public function ajaxgroup(Request $request)
    {
        if($request->ajax())
        {
            $recordBookId = $request->input('RecordBookId');
            $groupShortTitle = $request->input('val');
            Student::where('RecordBookId', $recordBookId)->update(['GroupShortTitle' =>$groupShortTitle]);

            return "Done";
        }
    }
}
