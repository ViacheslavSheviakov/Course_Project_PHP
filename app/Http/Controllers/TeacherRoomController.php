<?php

namespace App\Http\Controllers;


use App\Grade;
use App\Group;
use App\Professor;
use App\Schedule;
use App\Student;
use App\Teaching;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherRoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $view = redirect()->route('welcome');

        if ($user != null) {
            $professorSchedule = DB::table('professors')
                ->join('teaching', 'professors.ProfessorId', '=', 'teaching.ProfessorId')
                ->join('schedule', 'teaching.TeachingId', '=', 'schedule.TeachingId')
                ->where('professors.professorId', '=', $user->id)
                ->select('professors.professorId', 'teaching.SubjectShortTitle', 'schedule.ScheduleId', 'schedule.GroupShortTitle', 'schedule.LessonType', 'schedule.LessonDate', 'schedule.LessonNumber')
                ->orderBy('lessonDate')
                ->orderBy('lessonNumber')
                ->get();

            $scheduleStats = DB::table('schedule')
                ->select(DB::raw('GroupShortTitle, SubjectShortTitle, LessonType, count(LessonDate) as lessons_count'))
                ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
                ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
                ->where('ProfessorId', '=', $user->id)
                ->groupBy('GroupShortTitle', 'SubjectShortTitle', 'LessonType')
                ->get();

            $gradeStats = DB::table('grades')
                ->select(DB::raw('GroupShortTitle, SubjectShortTitle, LessonType, count(Grade) as l_grade'))
                ->join('schedule', 'grades.ScheduleId', '=', 'schedule.ScheduleId')
                ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
                ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
                ->join('professors', 'teaching.ProfessorId', '=', 'professors.ProfessorId')
                ->where('teaching.ProfessorId', '=', Auth::user()->id)
                ->groupBy('GroupShortTitle', 'SubjectShortTitle', 'LessonType')
                ->get();

            $routine = [];

            foreach ($professorSchedule as $lesson) {
                $date = (new \DateTime($lesson->LessonDate))->format('d.m.Y');
                $dataToInsert = [
                    $lesson->LessonType,
                    $lesson->SubjectShortTitle,
                    $lesson->GroupShortTitle,
                    $lesson->ScheduleId
                ];
                if (!isset($routine[$date])) {
                    $routine[$date] = [];
                }
                $routine[$date][($lesson->LessonNumber - 1)] = $dataToInsert;
            }


            $teacher = Professor::where('ProfessorId', $user->id)->first();
            $view = view('teacher.index')->with([
                'teacher' => $teacher,
                'routine' => $routine,
                'stats' => $scheduleStats,
                'grade_stats' => $gradeStats]);
        }

        return $view;
    }

    public function changedata(Request $request)
    {
        $teacher = new Professor();
        $currentid = $request->id;
        $teacher->Surname = $request->Surname;
        $teacher->Name = $request->Name;
        $teacher->Patronymic = $request->Patronymic;
        Professor::where('ProfessorId', $currentid)
            ->update($teacher);

        $teacher = Professor::all()->first();

        return view('teacher.index')->with('teacher', $teacher);
    }

    public function grades(Request $request)
    {
        $scheduleid = $request->input('sid');

        $grades = Grade::all()->where('ScheduleId', $scheduleid);
        $group = Schedule::all()->where('ScheduleId', $scheduleid)->pluck('GroupShortTitle')->first();
        $date = Schedule::all()->where('ScheduleId', $scheduleid)->pluck('LessonDate')->first();
        $students = Student::all()->where('GroupShortTitle', $group);
        $schedule = Schedule::all()->where('ScheduleId', $scheduleid)->first();

        $professor = $schedule->group->professor;

        return view('teacher.grades')->with([
            'students' => $students,
            'group' => $group,
            'date' => $date,
            'professor' => $professor,
            'grades' => $grades,
            'scheduleid' => $scheduleid
        ]);
    }

    public function ajaxgrades(Request $request)
    {
        $isGrade = Grade::all()->where('ScheduleId', $request->ScheduleId)->where('RecordBookId', $request->RecordBookId)->first();

        if ($isGrade == null) {
            $gradeApply = new Grade();
            $gradeApply->RecordBookId = $request->RecordBookId;
            $gradeApply->ScheduleId = $request->ScheduleId;
            $gradeApply->Grade = $request->Grade;
            $gradeApply->save();
        }
        else
        {
            Grade::where('GradeId', $isGrade->GradeId)->update(['Grade' => $request->Grade]);
        }
    }

    public function report()
    {
        $professor = Professor::all()->where('ProfessorId', Auth::user()->id)->first();
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $text = $professor->Surname . ' ' . $professor->Name . ' ' . $professor->Patronymic;
        $fontStyle = array('name' => 'Times New Roman', 'size' => 24, 'color' => '075776', 'bold' => TRUE);
        $section->addText(htmlspecialchars($text), $fontStyle);
        $fontStyle = array(
            'name' => 'Times New Roman',
            'size' => 14
        );
        $headFontStyle = array(
            'name' => 'Times New Roman',
            'bold' => true,
            'size' => 14
        );

        $scheduleStats = DB::table('schedule')
            ->select(DB::raw('GroupShortTitle, SubjectShortTitle, LessonType, count(LessonDate) as lessons_count'))
            ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
            ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
            ->where('ProfessorId', '=', Auth::user()->id)
            ->groupBy('GroupShortTitle', 'SubjectShortTitle', 'LessonType')
            ->get();

        $gradeStats = DB::table('grades')
            ->select(DB::raw('GroupShortTitle, SubjectShortTitle, LessonType, count(Grade) as l_grade'))
            ->join('schedule', 'grades.ScheduleId', '=', 'schedule.ScheduleId')
            ->join('lesson_types', 'schedule.LessonType', '=', 'lesson_types.TypeShortTitle')
            ->join('teaching', 'teaching.TeachingId', '=', 'schedule.TeachingId')
            ->join('professors', 'teaching.ProfessorId', '=', 'professors.ProfessorId')
            ->where('teaching.ProfessorId', '=', Auth::user()->id)
            ->groupBy('GroupShortTitle', 'SubjectShortTitle', 'LessonType')
            ->get();

        $teachings = $professor->teachings;

        $section->addText();
        $section->addText('Дисциплины', $headFontStyle);

        $tableStyle = array(
            'borderColor' => '006699',
            'borderSize' => 6,
            'cellMargin' => 100
        );
        $firstRowStyle = array('bgColor' => '66BBFF');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');
        $cellStyle = array(
            'valign' => 'center'
        );

        $table->addRow();
        $table->addCell(5000, $cellStyle)->addText('Аббревиатура', $headFontStyle);
        $table->addCell(5000, $cellStyle)->addText('Расшифровка', $headFontStyle);

        foreach ($teachings as $teach)
        {
            $table->addRow();
            $table->addCell(2500, $cellStyle)->addText($teach->SubjectShortTitle, $fontStyle);
            $table->addCell(2500, $cellStyle)->addText($teach->subject->SubjectFullTitle, $fontStyle);
        }

        $section->addText();
        $section->addText('Занятия', $headFontStyle);

        $tableStyle = array(
            'borderColor' => '006699',
            'borderSize' => 6,
            'cellMargin' => 100
        );
        $firstRowStyle = array('bgColor' => '66BBFF');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');
        $cellStyle = array(
            'valign' => 'center'
        );

        $table->addRow();
        $table->addCell(2500, $cellStyle)->addText('Группа', $headFontStyle);
        $table->addCell(2500, $cellStyle)->addText('Предмет', $headFontStyle);
        $table->addCell(2500, $cellStyle)->addText('Кол-во занятий', $headFontStyle);
        $table->addCell(2500, $cellStyle)->addText('Тип', $headFontStyle);

        foreach ($scheduleStats as $stat)
        {
            $table->addRow();
            $table->addCell(2500, $cellStyle)->addText($stat->GroupShortTitle, $fontStyle);
            $table->addCell(2500, $cellStyle)->addText($stat->SubjectShortTitle, $fontStyle);
            $table->addCell(2500, $cellStyle)->addText($stat->lessons_count, $fontStyle);
            $table->addCell(2500, $cellStyle)->addText($stat->LessonType, $fontStyle);
        }

        $section->addText();
        $section->addText('Оценки', $headFontStyle);

        $table2 = $section->addTable('myTable');
        $table2->addRow();
        $table2->addCell(2500, $cellStyle)->addText('Группа', $headFontStyle);
        $table2->addCell(2500, $cellStyle)->addText('Предмет', $headFontStyle);
        $table2->addCell(2500, $cellStyle)->addText('Кол-во оценок', $headFontStyle);
        $table2->addCell(2500, $cellStyle)->addText('Тип', $headFontStyle);

        foreach ($gradeStats as $stat)
        {
            $table2->addRow();
            $table2->addCell(2500, $cellStyle)->addText($stat->GroupShortTitle, $fontStyle);
            $table2->addCell(2500, $cellStyle)->addText($stat->SubjectShortTitle, $fontStyle);
            $table2->addCell(2500, $cellStyle)->addText($stat->l_grade, $fontStyle);
            $table2->addCell(2500, $cellStyle)->addText($stat->LessonType, $fontStyle);
        }


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save(storage_path('Professor_Results.docx'));
        return response()->download(storage_path('Professor_Results.docx'));
    }

}

