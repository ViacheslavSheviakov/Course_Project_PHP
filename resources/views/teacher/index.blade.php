@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватель</div>

                    <div class="panel-body">
                        <h3>
                            {{ $teacher->Surname }}
                            {{ $teacher->Name }}
                            {{ $teacher->Patronymic }}
                        </h3>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Статистика</div>

                    <div class="panel-body">
                        <h3>Занятия</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed">
                                <tr>
                                    <th>Группа</th>
                                    <th>Предмет</th>
                                    <th>Кол-во занятий</th>
                                    <th>Тип</th>
                                </tr>
                                @foreach($stats as $stat)
                                    <tr>
                                        <td>{{ $stat->GroupShortTitle }}</td>
                                        <td>{{ $stat->SubjectShortTitle }}</td>
                                        <td>{{ $stat->lessons_count }}</td>
                                        <td>{{ $stat->LessonType }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <h3>Оценки</h3>
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed">
                                <tr>
                                    <th>Группа</th>
                                    <th>Предмет</th>
                                    <th>Кол-во оценок</th>
                                    <th>Тип</th>
                                </tr>
                                @foreach($grade_stats as $stat)
                                    <tr>
                                        <td>{{ $stat->GroupShortTitle }}</td>
                                        <td>{{ $stat->SubjectShortTitle }}</td>
                                        <td>{{ $stat->l_grade }}</td>
                                        <td>{{ $stat->LessonType }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        {!! Form::open(['method' => 'POST', 'route' => 'professor.report']) !!}
                        {!! Form::submit('Скачать Отчёт', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close(); !!}
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Читаемые дисциплины</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Аббревиатура</th>
                                <th>Полное название</th>
                            </tr>
                            @foreach($teacher->teachings as $teaching)
                                <tr>
                                    <td><i>{{ $teaching->SubjectShortTitle }}</i></td>
                                    <td>{{ $teaching->subject->SubjectFullTitle }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

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
                                                {!! Form::open(['method' => 'POST', 'route' => 'grades']) !!}
                                                {!! Form::hidden('sid',$lessons[$i][3], array('class' => 'form-control')) !!}

                                                <span><small>{{ $lessons[$i][2] }}</small></span>
                                                <span class="lesson-type">{{ $lessons[$i][0] }}</span>
                                                {!! Form::submit($lessons[$i][1], ['class' => 'subject-title' ]) !!}
                                                {!! Form::close() !!}
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
@endsection