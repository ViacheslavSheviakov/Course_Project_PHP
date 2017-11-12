@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Студент</div>

                <div class="panel-body">
                    <h2>{{ $student->Surname }} {{ $student->Name }}</h2>
                    <h4>{{ $student->GroupShortTitle }}</h4>
                    <hr>
                    <h3>Рассписание</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Номер Пары</th>
                                <th>Дисциплина</th>
                                <th>Тип занятия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($student->group->schedules as $lesson)
                                <tr>
                                    <td>{{ $lesson->LessonDate }}</td>
                                    <td>{{ $lesson->LessonNumber }}</td>
                                    <td>{{ $lesson->teaching->SubjectShortTitle }}</td>
                                    <td>{{ $lesson->LessonType }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <h3>Оценки</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Дисциплина</th>
                            <th>Преподователь</th>
                            <th>Оценка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student->grades as $grade)
                            <tr>
                                <td>{{ $grade->schedule->LessonDate }}</td>
                                <td>{{ $grade->schedule->teaching->SubjectShortTitle }}</td>
                                <td>
                                    {{ $grade->schedule->teaching->professor->Surname }}
                                    {{ $grade->schedule->teaching->professor->Name }}
                                    {{ $grade->schedule->teaching->professor->Patronymic }}
                                </td>
                                <td>{{ $grade->Grade }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <h3>Скачать отчёт</h3>
                    <br>
                    <button class="btn btn-primary">Microsoft Word</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection