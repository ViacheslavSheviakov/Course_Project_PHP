<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use App\Subject;

class StudentPageController extends Controller
{
    public function index() {
        $students = Student::all();

        return view('student.page')->with('students', $students);
    }
}
