@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default panel-modest">
                    <div class="panel-heading">Список студентов</div>

                    <div class="panel-body">
                        
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
                                    <td id="id">{{ $student->RecordBookId }}</td>
                                    <td>{{ $student->Surname }}</td>
                                    <td>{{ $student->Name }}</td>
                                    <td>{{ $student->Patronymic }}</td>
                                    <td>
                                        <select id="chgroup" name="groupshorttitle" class="form-control">
                                            @foreach($groups as $group)
                                                <option value="{{$group->GroupShortTitle}}"
                                                        @if($group->GroupShortTitle===$student->GroupShortTitle) selected @endif>{{$group->GroupShortTitle}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>{{ $student->EnteringDate }}</td>
                                    {{--<td>{!! Form::open(['method' => 'GET', 'route' => ['studenteditorEdit', $student->RecordBookId],]) !!}--}}
                                        {{--{!! Form::submit('Изменить', ['class' => 'btn btn-primary','data-toggle'=>'confirmation', 'data-title'=>'Edit','data-content'=>'Edit student' ]) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--</td>--}}
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['studenteditorDel', $student->RecordBookId]]) !!}
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
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
@endsection
