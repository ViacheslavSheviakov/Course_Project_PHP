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
        //dump($request->input('SubjectShortTitle'));
        $surname = $request->input('Surname');
        $name = $request->input('Name');
        $patronymic = $request->input('Patronymic');
        $groupShortTitle = $request->input('GroupShortTitle');
        $timeNow = Carbon::now('Asia/Dhaka')->toDateString();

        if ($surname != "" && $name != "" && $patronymic != "" && $groupShortTitle != "") {
            DB::table('students')->insert
            (
                ['Surname' => $surname, 'Name' => $name, 'Patronymic' => $patronymic, 'GroupShortTitle' => $groupShortTitle, 'EnteringDate' => $timeNow,]
            );
        } else {

            return redirect()->route('studentEditorAdd');

        }
        $students = Student::all();
        //dump($request);
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
