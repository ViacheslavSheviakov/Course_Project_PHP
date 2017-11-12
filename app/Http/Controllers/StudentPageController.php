<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DB;

class StudentPageController extends Controller
{
    public function index() {
        $student = Student::all()[0];

        return view('student.page')->with('student', $student);
    }
}
