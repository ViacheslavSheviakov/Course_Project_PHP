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
    }

}
