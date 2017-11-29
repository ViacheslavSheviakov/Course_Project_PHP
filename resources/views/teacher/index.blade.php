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
                    <div class="panel-heading">Персональные данные</div>

                    <div class="panel-body">
                        <p>Здесь Вы можете изменить свой E-mail и Пароль</p>
                        <a href="edit" class="btn btn-primary btn-block">Изменить</a>
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
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
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