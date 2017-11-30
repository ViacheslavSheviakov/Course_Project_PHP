@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Конструктор рассписания</div>
                    <div class="panel-body">
                        <h3>Сгенерировать</h3>
                        {!! Form::open(['method' => 'POST', 'route' => ['schedule-generate']]) !!}
                        {!! Form::hidden('id',$professor->ProfessorId, array('class' => 'form-control')) !!}
                        <table class="table table-striped">
                            <tr>
                                <th>Дисциплина</th>
                                <th>Тип</th>
                                <th>Группа</th>
                                <th>Действие</th>
                            </tr>

                            <tr>
                                <td>
                                    <select id="teach" name="teach" class="form-control">
                                        @foreach($professor->teachings as $teaching)
                                            <option value="{{$teaching->TeachingId}}">{{$teaching->SubjectShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="type" name="type" class="form-control">
                                        @foreach(\App\LessonType::all() as $type)
                                            <option value="{{$type->TypeShortTitle}}">{{$type->TypeShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="group" name="group" class="form-control">
                                        @foreach(\App\Group::all() as $group)
                                            <option value="{{$group->GroupShortTitle}}">{{$group->GroupShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>{!! Form::submit('Сгенерировать', ['class' => 'btn btn-primary']) !!}</td>
                            </tr>
                        </table>
                        {!! Form::close() !!}

                        <h3>Добавить</h3>
                        {!! Form::open(['method' => 'POST', 'route' => ['schedule-save']]) !!}
                        {!! Form::hidden('id',$professor->ProfessorId, array('class' => 'form-control')) !!}
                        <table class="table table-striped">
                            <tr>
                                <th>Дата</th>
                                <th>Дисциплина</th>
                                <th>Тип</th>
                                <th>Группа</th>
                                <th>Пара</th>
                                <th>Действие</th>
                            </tr>

                            <tr>
                                <td>
                                    <input type="date" name="date" class="form-control"/>
                                </td>
                                <td>
                                    <select id="subj" name="subj" class="form-control">
                                        @foreach($professor->teachings as $teaching)
                                            <option value="{{$teaching->SubjectShortTitle}}">{{$teaching->SubjectShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="type" name="type" class="form-control">
                                        @foreach(\App\LessonType::all() as $type)
                                            <option value="{{$type->TypeShortTitle}}">{{$type->TypeShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select id="group" name="group" class="form-control">
                                        @foreach(\App\Group::all() as $group)
                                            <option value="{{$group->GroupShortTitle}}">{{$group->GroupShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    {{ Form::selectRange('lesson-number', 1, 7, 1, array('class' => 'form-control')) }}
                                </td>
                                <td>{!! Form::submit('Сохранить', ['class' => 'btn btn-primary']) !!}</td>
                            </tr>
                        </table>
                        {!! Form::close() !!}

                        <table class="table">
                            <tr>
                                <th>Дата</th>
                                <th>Дисциплина</th>
                                <th>Тип</th>
                                <th>Группа</th>
                                <th>Пара</th>
                                <th>Действие</th>
                            </tr>
                            @foreach($professor->teachings as $teaching)
                                @foreach($teaching->schedules as $scheduleM)
                                    <tr>
                                        <td>{{ $scheduleM->LessonDate }}</td>
                                        <td>{{ $teaching->SubjectShortTitle }}</td>
                                        <td>{{ $scheduleM->LessonType }}</td>
                                        <td>{{ $scheduleM->GroupShortTitle }}</td>
                                        <td>{{ $scheduleM->LessonNumber }}</td>
                                        <td>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['schedule-step-2-del', $scheduleM->ScheduleId]]) !!}
                                            {!! Form::hidden('id', $professor->ProfessorId, array('class' => 'form-control')) !!}
                                            {!! Form::hidden('sid', $scheduleM->ScheduleId, array('class' => 'form-control')) !!}
                                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection