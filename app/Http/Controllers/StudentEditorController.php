<?php

namespace App\Http\Controllers;

use App\Student;
use App\Group;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        if ($request->Surname != "" && $request->Name != "" && $request->Patronymic != "" && $request->GroupShortTitle != "") {
            $student = new Student();
            $student->Surname = $request->Surname;
            $student->Name = $request->Name;
            $student->Patronymic = $request->Patronymic;
            $student->GroupShortTitle = $request->GroupShortTitle;
            $student->EnteringDate = $timeNow;
            $student->save();
        } else {
            return redirect()->route('studentEditorAdd');
        }
        $students = Student::all();

        return view('studenteditor.index')->with([
            'students'=> $students,'groups'=>$groups]);
    }

//    public function edit($id)
//    {
//        $student = Student::where('RecordBookId', $id)->first();
//        $groups = Group::all();
//        dump($student);
//        return view('studenteditor.edit')->with(['student' => $student, 'groups' => $groups]);
//
//    }

//    public function edited(Request $request)
//    {
//        $recordBookId = $request->input('RecordBookId');
//        dump($request);
//        // return redirect()->route('studentEditor')->with('flash_message', 'User successfully edited.');
//
//    }

    public function del($id)
    {
        Student::where('RecordBookId', '=', $id)->delete();
        return redirect()->route('studentEditor')->with('flash_message', 'User successfully deleted.');
    }

    public function ajaxgroup(Request $request)
    {
        if($request->ajax()) {
            $recordBookId = $request->input('RecordBookId');
            $groupShortTitle = $request->input('val');
            Student::where('RecordBookId', $recordBookId)
                ->update(['GroupShortTitle' =>$groupShortTitle]);
            return "Done";
        }
    }
}
