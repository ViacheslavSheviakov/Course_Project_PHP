@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <h3>Предметы</h3>
                        <a class="btn btn-default" href="{{route('subjectAdd')}}" role="button">Добавить</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Сокращение</th>
                                <th>Дисциплина</th>
                                <th>Кредиты</th>
                                <th>Преподаватель</th>
                                <th colspan="2" class="text-center">Инструменты</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->SubjectShortTitle }}</td>
                                    <td>{{ $subject->SubjectFullTitle }}</td>
                                    <td>{{ $subject->Credits }}</td>
                                    <td>{{'Преподаватель' }}</td>
                                    <td><a class="btn btn-default" href="{{route('subjectEdit',['id'=>$subject->SubjectShortTitle])}}" role="button">Изменить</a></td>
                                    <td><a class="btn btn-default" href="{{route('subjectDel',['del'=>$subject->SubjectShortTitle])}}" role="button">Удалить</a></td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--<h1>Subjects</h1>--}}
{{--{{$mess}}--}}

{{--@foreach($subjects as $subject)--}}
    {{--<p>{{$subject->SubjectShortTitle}}</p>--}}
    {{--<p>{{$subject->SubjectFullTitle}}</p>--}}
    {{--<p>{{$subject->Credits}}</p>--}}
{{--<hr>--}}

{{--@endforeach--}}