@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <h3>Список студентов</h3>
                        <a class="btn btn-success" href="{{route('studentEditorAdd')}}" role="button">Добавить</a>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Номер зачетки</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Группа</th>
                                <th>Дата добавления</th>
                                <th>Инструменты</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->RecordBookId }}</td>
                                    <td>{{ $student->Surname }}</td>
                                    <td>{{ $student->Name }}</td>
                                    <td>{{ $student->Patronymic }}</td>
                                    <td>{{ $student->GroupShortTitle }}</td>
                                    <td>{{ $student->EnteringDate }}</td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['studenteditorDel', $student->RecordBookId],]) !!}
                                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger','data-toggle'=>'confirmation', 'data-title'=>'Delete','data-content'=>'Delete student' ]) !!}
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