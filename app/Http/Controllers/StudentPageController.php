<?php

namespace App\Http\Controllers;

use App\Student;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class StudentPageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user == null) {
            return "You have to be logged in!";
        }

        $student = Student::all()->where('RecordBookId', Auth::user()->id)->first();
        $grades_stats = DB::table('grades')
            ->select(DB::raw('lesson_types.TypeShortTitle, avg(grades.Grade) as avgGrade'))
            ->join('schedule', 'grades.ScheduleId', '=', 'schedule.ScheduleId')
            ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
            ->where('grades.RecordBookId', '=', Auth::user()->id)
            ->groupBy('lesson_types.TypeShortTitle')
            ->get();

        $routine = [];

        foreach ($student->group->schedules as $lesson) {
            $date = (new \DateTime($lesson->LessonDate))->format('d.m.Y');
            $dataToInsert = [
                $lesson->LessonType,
                $lesson->teaching->SubjectShortTitle,
            ];
            if (!isset($routine[$date])) {
                $routine[$date] = [];
            }
            $routine[$date][($lesson->LessonNumber - 1)] = $dataToInsert;
        }

        return view('student.page')->with([
            'student' => $student,
            'routine' => $routine,
            'grade_stats' => $grades_stats
        ]);
    }

    public function grades()
    {
        $grades = DB::table('grades')
            ->select(
                'LessonDate',
                'SubjectShortTitle',
                'LessonType',
                'Surname',
                'Name',
                'Patronymic',
                'Grade')
            ->join('schedule', 'grades.ScheduleId', '=', 'schedule.ScheduleId')
            ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
            ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
            ->join('professors', 'teaching.ProfessorId', '=', 'professors.ProfessorId')
            ->where('grades.RecordBookId', '=', Auth::user()->id)
            ->get();

        return view('student.grades')->with('grades', $grades);
    }

    public function gradesProcess(Request $request)
    {
        $grades = DB::table('grades')
            ->select(
                'LessonDate',
                'SubjectShortTitle',
                'LessonType',
                'Surname',
                'Name',
                'Patronymic',
                'Grade')
            ->join('schedule', 'grades.ScheduleId', '=', 'schedule.ScheduleId')
            ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
            ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
            ->join('professors', 'teaching.ProfessorId', '=', 'professors.ProfessorId')
            ->where('grades.RecordBookId', '=', Auth::user()->id);

        $statement = 'LIKE';
        $order = $request->input('order');

        $date_from = $request->input('date-from');
        $date_to = $request->input('date-to');

        if ($date_from != null)
        {
            $grades->where('schedule.LessonDate', '>=', $date_from);
        }

        if ($date_to != null)
        {
            $grades->where('schedule.LessonDate', '<=', $date_to);
        }

        $tmp = [
            'LessonType' => $request->input('lesson-type'),
            'Grade' => $request->input('grade')
        ];

        if ($request->input('p-type') == 'search')
        {
            $statement = '=';
            $grades->take(1);
        }

        foreach ($tmp as $fieldInDB => $fieldInRequest)
        {
            if ($fieldInRequest != null)
            {
                $criteria = $fieldInRequest;

                if ($statement == 'LIKE')
                {
                    $criteria = '%' . $criteria . '%';
                }

                $grades->where($fieldInDB, $statement, $criteria);
            }
        }

        if ($request->input('s-type') != null)
        {
            foreach ($request->input('s-type') as $criteria)
            {
                $grades->orderBy($criteria, $order);
            }
        }

        $grades = $grades->get();


        return view('student.grades')->with('grades', $grades);
    }

    public function report()
    {
        $student = Student::all()->where('RecordBookId', Auth::user()->id)->first();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $text = $student->Surname . ' ' . $student->Name . ' ' . $student->Patronymic;
        $fontStyle = array('name' => 'Times New Roman', 'size' => 24, 'color' => '075776', 'bold' => TRUE);
        $section->addText(htmlspecialchars($text), $fontStyle);
        $text = 'Группа: ' . $student->GroupShortTitle;
        $fontStyle = array('name' => 'Times New Roman', 'size' => 18, 'color' => '075776');
        $section->addText(htmlspecialchars($text), $fontStyle);
        $section->addText();
        $tableStyle = array(
            'borderColor' => '006699',
            'borderSize' => 6,
            'cellMargin' => 100
        );
        $firstRowStyle = array('bgColor' => '66BBFF');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');
        $headFontStyle = array(
            'name' => 'Times New Roman',
            'bold' => true,
            'size' => 14
        );
        $fontStyle = array(
            'name' => 'Times New Roman',
            'size' => 14
        );
        $cellStyle = array(
            'valign' => 'center'
        );
        $table->addRow();
        $table->addCell(2500, $cellStyle)->addText('Дата', $headFontStyle);
        $table->addCell(2500, $cellStyle)->addText('Дисциплина', $headFontStyle);
        $table->addCell(2500, $cellStyle)->addText('Преподаватель', $headFontStyle);
        $table->addCell(2500, $cellStyle)->addText('Оценка', $headFontStyle);
        foreach ($student->grades as $grade) {
            $professor = $grade->schedule->teaching->professor;
            $table->addRow();
            $table->addCell(2500, $cellStyle)->addText($grade->schedule->LessonDate, $fontStyle);
            $table->addCell(2500, $cellStyle)->addText($grade->schedule->teaching->SubjectShortTitle, $fontStyle);
            $table->addCell(2500, $cellStyle)->addText(
                $professor->Surname . ' ' .
                $professor->Name . ' ' .
                $professor->Patronymic,
                $fontStyle
            );
            $table->addCell(2500, $cellStyle)->addText($grade->Grade, $fontStyle);
        }
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(storage_path('Student_Results.docx'));
        return response()->download(storage_path('Student_Results.docx'));
    }
}