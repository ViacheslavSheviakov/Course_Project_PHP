<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;

class StudentPageController extends Controller
{
    public function index() {
        $subjects = Subject::all();
        $toReturn = false;

        foreach ($subjects as $subject) {
            $toReturn = $subject->SubjectShortTitle;
        }
        return view('student.page')->with('subject', $toReturn);
    }
}
