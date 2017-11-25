<?php

namespace App\Http\Controllers;

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
        if ($request->SubjectShortTitle != "" && $request->SubjectFullTitle != "" && $request->Credits != "") {
            $subject = new  Subject();
            $subject->SubjectShortTitle=$request->SubjectShortTitle;
            $subject->SubjectFullTitle=$request->SubjectFullTitle;
            $subject->Credits=$request->Credits;
            $subject->save();
//            DB::table('subjects')->insert(
//                ['SubjectShortTitle' => $SubjectShortTitle, 'SubjectFullTitle' => $SubjectFullTitle, 'Credits' => $Credits]
//            );
        } else {
            return redirect()->route('subjectAdd');
        }
        $subjects = Subject::all();
        return view('subject.index')->with(
            'subjects', $subjects);
    }

    public function del($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return redirect()->route('subject')->with('flash_message','User successfully deleted.');
//
//
//
///////////second version///////////
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
        ///////////second version///////////
    }

}
