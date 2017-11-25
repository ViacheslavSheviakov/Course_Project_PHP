<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use DB;

class StudentPageController extends Controller
{
    public function index() {
        $student = Student::all()[0];

        $data = DB::select('
          SELECT *
          FROM `schedule` S, `teaching` T
          WHERE S.GroupShortTitle = ? AND S.TeachingId = T.TeachingId
          ', [$student->GroupShortTitle]);

        $grades = DB::select('
            SELECT *
            FROM `grades` G, `schedule` S, `teaching` T, `professors` P
            WHERE G.RecordBookId = ? 
            AND G.ScheduleId = S.ScheduleId
            AND S.TeachingId = T.TeachingId
            AND T.ProfessorId = P.ProfessorId
        ', [$student->RecordBookId]);

        return view('student.page')->with('data', [$student, $data, $grades]);
    }
}
