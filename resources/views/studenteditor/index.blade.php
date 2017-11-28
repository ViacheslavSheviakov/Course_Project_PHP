@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default panel-modest">
                    <div class="panel-heading">Список студентов</div>

                    <div class="panel-body">

                        <a class="btn btn-success" href="{{route('studentEditorAdd')}}" role="button">Добавить</a>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#settings">Настрйки поиска</button>
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
    <div id="settings" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Настройки поиска и фильтрации</h4>
                </div>
                {!! Form::open(['method' => 'GET', 'route' => 'studenteditor.process']) !!}
                <div class="modal-body">
                    <table class="table table-condensed table-striped">
                        <tr>
                            <td>Номер зачетки</td>
                            <td>{!! Form::text('record-book-id', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Фамилия</td>
                            <td>{!! Form::text('surname', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Имя</td>
                            <td>{!! Form::text('name', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Отчество</td>
                            <td>{!! Form::text('patronymic', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Группа</td>
                            <td>{!! Form::select('group', collect([null => '-'])->merge(\App\Group::all()->pluck('GroupShortTitle', 'GroupShortTitle')), null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Дата поступления</td>
                            <td>{!! Form::date('arrival-date', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Тип обработки</td>
                            <td>
                                {!! Form::radio('p-type', 'search', false, ['id' => 'p-type-0']); !!}
                                {!! Form::label('p-type-0', 'Поиск'); !!}
                                <br>
                                {!! Form::radio('p-type', 'filtering', false, ['id' => 'p-type-1']); !!}
                                {!! Form::label('p-type-1', 'Фильтрация'); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>Сортировка</td>
                            <td>
                                {!! Form::checkbox('s-type[]', 'Surname', false, ['id' => 's-type-0']); !!}
                                {!! Form::label('s-type-0', 'Фамилия'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'Name', false, ['id' => 's-type-1']); !!}
                                {!! Form::label('s-type-1', 'Имя'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'Patronymic', false, ['id' => 's-type-2']); !!}
                                {!! Form::label('s-type-2', 'Отчество'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'GroupShortTitle', false, ['id' => 's-type-3']); !!}
                                {!! Form::label('s-type-3', 'Группа'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'EnteringDate', false, ['id' => 's-type-4']); !!}
                                {!! Form::label('s-type-4', 'Дата поступления'); !!}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    {!! Form::submit('Применить', ['class' => 'btn btn-success' ]) !!}
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Отмена</button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
@endsection
