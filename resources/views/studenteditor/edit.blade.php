{{--@extends('layouts.app')--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-12 col-md-offset-0">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-body">--}}
                        {{--<h3>Добавление студента</h3>--}}
                        {{--{{ Form::open(array('route' => 'studentEditorEdited')) }}--}}
                        {{--<table class="table table-striped">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th>Номер зачетки</th>--}}
                                {{--<th>Фамилия</th>--}}
                                {{--<th>Имя</th>--}}
                                {{--<th>Отчество</th>--}}
                                {{--<th>Группа</th>--}}
                                {{--<th>Инструменты</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<td >{{ Form::label('RecordBookId',$student->RecordBookId , array('class' => 'form-control')) }}</td>--}}
                                {{--<td>{{ $student->Surname }}</td>--}}
                                {{--<td>{{ $student->Name }}</td>--}}
                                {{--<td>{{ $student->Patronymic }}</td>--}}
                                {{--<td>--}}
                                    {{--<select name="GroupShortTitle" class="form-control">--}}
                                         {{--@foreach($groups as $group)--}}
                                            {{--<option value="{{$group->GroupShortTitle}}">{{$group->GroupShortTitle}}</option>--}}
                                        {{--@endforeach--}}
                                         {{--</select>--}}
                                {{--</td>--}}
                                {{--<td>--}}
                                    {{--{{ Form::submit('Изменить', array('class' => 'btn btn-success btn-lg btn-block')) }}--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                        {{--{{ Form::close() }}--}}
                        {{--<br>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<a class="button btn-default" href="{{route('studentEditor')}}" role="button"> Список студентов</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}