@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <h3>Предметы</h3>
                        <a class="btn btn-success" href="{{route('subjectAdd')}}" role="button">Добавить</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Сокращение</th>
                                <th>Дисциплина</th>
                                <th>Кредиты</th>
                                <th>Инструменты</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->SubjectShortTitle }}</td>
                                    <td>{{ $subject->SubjectFullTitle }}</td>
                                    <td>{{ $subject->Credits }}</td>
                                    <td>
                                        {{--<a class="btn btn-default"--}}
                                           {{--href="{{route('subjectDel',['del'=>$subject->SubjectShortTitle])}}"--}}
                                           {{--role="button">Удалить</a>--}}
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['subjectDel', $subject->SubjectShortTitle],]) !!}
                                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger','data-toggle'=>'confirmation', 'data-title'=>'Delete','data-content'=>'Delete user' ]) !!}
                                        {!! Form::close() !!}
                                    </td>

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