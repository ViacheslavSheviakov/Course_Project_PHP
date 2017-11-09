<?php

namespace App\Http\Controllers;

use App\Student;
use App\Group;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StudentEditorController extends Controller
{

    public function index()
    {
        $students = Student::all();
        //dump($subjects);
        return view('studenteditor.index')->with('students' , $students);
    }

    public function add()
    {
        $groups=Group::all();
        return view('studenteditor.add')->with('groups',$groups) ;
    }

    public function added(Request $request)
    {
        //dump($request->input('SubjectShortTitle'));
        $surname = $request->input('Surname');
        $name= $request->input('Name');
        $patronymic = $request->input('Patronymic');
        $groupShortTitle = $request->input('GroupShortTitle');
        $timeNow=Carbon::now('Asia/Dhaka')->toDateString();


        if ($surname != "" && $name != "" && $patronymic != ""&&$groupShortTitle!="") {
            // DB::insert('INSERT INTO subjects (SubjectShortTitle, SubjectFullTitle, Credits) VALUES ($SubjectShortTitle, $SubjectFullTitle, $Credits)');
            DB::table('students')->insert(
                ['Surname' => $surname, 'Name' => $name, 'Patronymic' => $patronymic, 'GroupShortTitle' => $groupShortTitle, 'EnteringDate' => $timeNow,]
            );
        } else {
           // return view('studenteditor.add')->with('mess', $message = "Не верный ввод");
            //dump($message);
            return redirect()->route('studentEditorAdd');

        }
        $students = Student::all();
        return view('studenteditor.index')->with(
            'students', $students);
    }

    public function del($id)
    {
        //$student =
            Student::where('RecordBookId', '=', $id)->delete();
        //$student->delete();
        return redirect()->route('studentEditor')->with('flash_message','User successfully deleted.');
    }

}
