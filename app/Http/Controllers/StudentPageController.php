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

        //return $this->d($student);

        return view('student.page')->with('data', [$student, $routine]);
    }

    public function report(Request $request) {

        $student = Student::all()->where('RecordBookId', $request->input('stuid'))->first();

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();

        $text = $student->Surname . ' ' . $student->Name . ' ' . $student->Patronymic;
        $fontStyle = array('name'=>'Times New Roman', 'size'=>24, 'color'=>'075776', 'bold'=>TRUE);

        $section->addText(htmlspecialchars($text), $fontStyle);

        $text = 'Группа: ' . $student->GroupShortTitle;
        $fontStyle = array('name'=>'Times New Roman', 'size'=>18, 'color'=>'075776');

        $section->addText(htmlspecialchars($text), $fontStyle);
        $section->addText();

        $tableStyle = array(
            'borderColor' => '006699',
            'borderSize'  => 6,
            'cellMargin'  => 100
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
