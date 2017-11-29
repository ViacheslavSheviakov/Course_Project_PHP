@extends('layouts.app')

@section('content')
    @role('Student')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Студент</div>

                    <div class="panel-body">
                        <h3>
                            {{ $student->Surname }}
                            {{ $student->Name }}
                            {{ $student->Patronymic }}
                        </h3>
                        <h4>Группа: {{ $student->GroupShortTitle }}</h4>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Оценки</div>

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
                    </div>
                </div>

                <a href="{{ route('student.grades') }}" class="btn btn-default btn-block">
                    Электронный дневник
                </a>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Рассписание</div>

                    <div class="panel-body">
                        <div class="schedule">
                            @foreach($routine as $date => $lessons)
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection