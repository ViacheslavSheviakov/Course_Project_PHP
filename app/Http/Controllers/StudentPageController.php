<?php

namespace App\Http\Controllers;

use App\Student;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use DB;

class StudentPageController extends Controller
{
    public function index() {
        $student = Student::all()[0];

        $routine = [];

        foreach($student->group->schedules as $lesson)
        {
            $date = (new \DateTime($lesson->LessonDate))->format('d.m.Y');

            $dataToInsert = [
                $lesson->LessonType,
                $lesson->teaching->SubjectShortTitle,
            ];

            if (!isset($routine[$date]))
            {
                $routine[$date] = [];
            }

            $routine[$date][($lesson->LessonNumber - 1)] = $dataToInsert;
        }

        return view('student.page')->with('data', [$student, $routine]);
    }
}
