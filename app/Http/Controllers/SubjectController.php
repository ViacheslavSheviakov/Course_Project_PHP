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
        return view('subject.index') -> with(['mess'=>$message,
                                                    'subjects'=> $subjects]);
    }

    public function edit($id)
    {
        $subjects = DB::select('select * from subjects where SubjectShortTitle = :id', ['id'=> $id]);
        $message = "test message";
        //dump($subjects);
        return view('subject.edit') -> with([
            'mess'=>$message
            ,'subjects'=> $subjects
        ]);
    }
    public function del($id)
    {
        $subjects = DB::select('select * from subjects where SubjectShortTitle = :id', ['id'=> $id]);
        $message = "test message";
        dump($subjects);
        return view('subject.edit') -> with([
            'mess'=>$message
            ,'subjects'=> $subjects
        ]);
    }

}
