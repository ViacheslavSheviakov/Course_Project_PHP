<?php

namespace App\Http\Controllers;

use App\Role;
use App\Student;
use App\Group;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

        return redirect()->route('studentEditor');
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

            return "Группа изменена";
        }
    }

    public function process(Request $request)
    {
        $students = DB::table('students');
        $groups = Group::all();
        $statement = 'LIKE';
        $order = $request->input('order');

        $tmp = [
            'RecordBookId' => $request->input('record-book-id'),
            'Surname' => $request->input('surname'),
            'Name' => $request->input('name'),
            'Patronymic' => $request->input('patronymic'),
            'GroupShortTitle' => $request->input('group'),
            'EnteringDate' => $request->input('arrival-date'),
        ];

        if ($request->input('p-type') == 'search')
        {
            $statement = '=';
        }

        foreach ($tmp as $fieldInDB => $fieldInRequest)
        {
            if ($fieldInRequest != null)
            {
                $criteria = $fieldInRequest;

                if ($fieldInDB == 'EnteringDate')
                {
                    $date = date('Y-m-d', strtotime($criteria));
                    $students->where($fieldInDB, '=', $date);
                    continue;
                }

                if ($statement == 'LIKE')
                {
                    $criteria = '%' . $criteria . '%';
                }

                $students->where($fieldInDB, $statement, $criteria);
            }
        }

        if ($request->input('s-type') != null)
        {
            foreach ($request->input('s-type') as $criteria)
            {
                $students->orderBy($criteria, $order);
            }
        }

        $students = $students->get();

        return view('studenteditor.index')->with(['students'=> $students,'groups' => $groups]);
    }
}
