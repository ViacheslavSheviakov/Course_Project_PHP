@extends('layouts.app')

@section('content')
    @role('Student')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Студент</div>

                    <div class="panel-body">
                        <h3>
                            {{ $student->Surname }}
                            {{ $student->Name }}
                            {{ $student->Patronymic }}
                        </h3>
                        <h4>Группа: {{ $student->GroupShortTitle }}</h4>
                    </div>
                </div>

                @if ($student->group->professor != null)
                    <div class="panel panel-default">
                        <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> Куратор группы</div>

                        <div class="panel-body">
                            <h3>
                                {{ $student->group->professor->Surname }}
                                {{ $student->group->professor->Name }}
                                {{ $student->group->professor->Patronymic }}
                            </h3>
                        </div>
                    </div>
                @endif

            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-calendar"></span> Рассписание</div>

                    <div class="panel-body">
                        <div class="schedule">
                            @foreach($routine as $date => $lessons)
                                <div class="day">
                                    <h3>{{ $date }}</h3>
                                    @for($i = 0; $i < 8; $i++)
                                        <div class="lesson">
                                            @if(isset($lessons[$i]))
                                                <span class="time">
                                                @if($i == 0)
                                                        <b>7:45</b>
                                                    @elseif($i == 1)
                                                        <b>9:30</b>
                                                    @elseif($i == 2)
                                                        <b>11:15</b>
                                                    @elseif($i == 3)
                                                        <b>13:10</b>
                                                    @elseif($i == 4)
                                                        <b>14:55</b>
                                                    @elseif($i == 5)
                                                        <b>16:30</b>
                                                    @endif
                                                </span>
                                                <span class="lesson-type">{{ $lessons[$i][0] }}</span>
                                                <span class="subject-title">{{ $lessons[$i][1] }}</span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="glyphicon glyphicon-book"></span> Оценки</div>
                    <div class="panel-body">
                        <h3>Статистика</h3>
                        <table class="table table-hover">
                            <thead>
                            <tr class="small">
                                <th>Тип занятия</th>
                                <th>Ср. балл</th>
                                <th>ECTS</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($grade_stats as $grade)
                                <tr>
                                    <td>{{ $grade->TypeShortTitle }}</td>
                                    <td>{{ number_format($grade->avgGrade, 2, '.', ',') }}</td>
                                    <td>
                                        @if($grade->avgGrade >= 96)
                                            <b>A</b>
                                        @elseif($grade->avgGrade >= 75 && $grade->avgGrade <= 95)
                                            <b>B</b>
                                        @elseif($grade->avgGrade >= 66 && $grade->avgGrade <= 74)
                                            <b>D</b>
                                        @elseif($grade->avgGrade >= 60 && $grade->avgGrade <= 65)
                                            <b>E</b>
                                        @elseif($grade->avgGrade >= 35 && $grade->avgGrade <= 59)
                                            <b>FX</b>
                                        @elseif($grade->avgGrade >= 1 && $grade->avgGrade <= 34)
                                            <b>F</b>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('student.grades') }}" class="btn btn-primary btn-block">
                            Электронный дневник
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endrole
@endsection
