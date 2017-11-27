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
    </div>


            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Рассписание</h3></div>

                    <div class="panel-body">
                        <div class="schedule">
                            @foreach($professorSchedule as $lesson)
                                <div class="day">
                                    <h3>{{ $lesson->lessonDate }}</h3>
                                    @for($i = 0; $i < 8; $i++)
                                        <div class="lesson">
                                            @if($lesson->lessonNumber==$i)
                                                <span class="lesson-type">{{ $lesson->LessonType }}</span>
                                                <span class="subject-title">{{ $lesson->SubjectShortTitle }}</span>
                                            @endif
                                        </div>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading"><h3>Отчёт</h3></div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<form method="POST" action="report">--}}
                            {{--{{ csrf_field() }}--}}
                            {{--<input type="hidden" name="stuid" id="stuid" value="{{ $data[0]->RecordBookId }}">--}}
                            {{--<input type="submit" class="btn btn-primary" value="Microsoft Word">--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>
@endsection