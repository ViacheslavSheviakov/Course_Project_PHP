<?php

namespace App\Http\Controllers;

use App\Professor;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{

    public function index()
    {
        $subjects = Subject::all();
        $message = "test message";
        //dump($subjects);
        return view('subject.index')->with(['mess' => $message,
            'subjects' => $subjects]);
    }

    public function add()
    {
        return view('subject.add');
    }

    public function added(Request $request)
    {
        $message = "test message";

        //dump($request->input('SubjectShortTitle'));
        $SubjectShortTitle = $request->input('SubjectShortTitle');
        $SubjectFullTitle = $request->input('SubjectFullTitle');
        $Credits = $request->input('Credits');
        if ($SubjectShortTitle != "" && $SubjectFullTitle != "" && $Credits != "") {
           // DB::insert('INSERT INTO subjects (SubjectShortTitle, SubjectFullTitle, Credits) VALUES ($SubjectShortTitle, $SubjectFullTitle, $Credits)');
            DB::table('subjects')->insert(
                ['SubjectShortTitle' => $SubjectShortTitle, 'SubjectFullTitle' => $SubjectFullTitle, 'Credits' => $Credits]
            );
        } else {
            return view('subject.add')->with('mess', $message = "Не верный ввод");
        }
        $subjects = Subject::all();
        return view('subject.index')->with(['mess' => $message,
            'subjects' => $subjects]);
    }

    public function del($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('subject')->with('flash_message','User successfully deleted.');
//
//
//
//
//        if($id!=null&&$id!="")
//        {
//            DB::table('subjects')->where('SubjectShortTitle', '=', $id)->delete();
//        }
//
//        $subjects = Subject::all();
//        $message = "test message";
//        dump($subjects);
//        return view('subject.index')->with([
//            'mess' => $message
//            , 'subjects' => $subjects
//        ]);
    }

}
