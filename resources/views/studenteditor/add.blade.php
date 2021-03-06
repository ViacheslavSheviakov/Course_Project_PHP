@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление студента</div>

                    <div class="panel-body">

                        {{ Form::open(['method' => 'GET', 'route' => 'studentEditorAdded']) }}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>E-mail</th>
                                <th>Группа</th>
                                <th>Инструменты</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ Form::text('Surname', null, array('class' => 'form-control')) }}</td>
                                <td>{{ Form::text('Name', null, array('class' => 'form-control')) }}</td>
                                <td>{{ Form::text('Patronymic', null, array('class' => 'form-control')) }}</td>
                                <td>{{ Form::text('Email', null, array('class' => 'form-control')) }}</td>
                                <td>
                                    <select name="GroupShortTitle" class="form-control">
                                        @foreach($groups as $group)
                                            <option value="{{$group->GroupShortTitle}}">{{$group->GroupShortTitle}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    {{ Form::submit('Добавить', array('class' => 'btn btn-success btn-block')) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                        <br>
                    </div>
                </div>
                <a class="btn btn-default" href="{{ route('studentEditor') }}" role="button"> Список студентов</a>
            </div>
        </div>
    </div>
@endsection