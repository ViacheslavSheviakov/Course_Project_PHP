@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Студент</div>

                <div class="panel-body">
                    <h2>{{ $data[0]->Surname }} {{ $data[0]->Name }}</h2>
                    <h4>{{ $data[0]->GroupShortTitle }}</h4>
                    <hr>
                    <h3>Рассписание</h3>
                    <div class="schedule">
                        @foreach($data[1] as $date => $lessons)
                            <div class="day">
                                <h3>{{ $date }}</h3>
                                @for($i = 0; $i < 8; $i++)
                                    <div class="lesson">
                                        @if(isset($lessons[$i]))
                                        <span class="lesson-type">{{ $lessons[$i][0] }}</span>
                                        <span class="subject-title">{{ $lessons[$i][1] }}</span>
                                        @endif
                                    </div>
                                @endfor
                            </div>
                        @endforeach
                    </div>

                    <br>
                    <h3>Оценки</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr class="small">
                            <th>Дата</th>
                            <th>Д-а</th>
                            <th>П-ль</th>
                            <th>Оценка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data[0]->grades as $grade)
                            <tr>
                                <td>{{ $grade->schedule->LessonDate }}</td>
                                <td>{{ $grade->schedule->teaching->SubjectShortTitle }}</td>
                                <td>
                                    {{ $grade->schedule->teaching->professor->Surname }}<br>
                                    {{ $grade->schedule->teaching->professor->Name }}<br>
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