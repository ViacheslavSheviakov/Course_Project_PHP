@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватели</div>

                    <div class="panel-body">
                        <a href="add" class="btn btn-success">Добавить</a>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#settings">Настрйки поиска</button>
                        <br><br>
                        <table class="table table-striped">
                            <tr>
                                <th>ID</th>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th colspan="2">Действия</th>
                            </tr>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>
                                        {{ $teacher->ProfessorId }}
                                    </td>
                                    <td>
                                        {{ $teacher->Surname }}
                                    </td>
                                    <td>
                                        {{ $teacher->Name }}
                                    </td>
                                    <td>
                                        {{ $teacher->Patronymic }}
                                    </td>
                                    <td>
                                        {{ Form::open(['method' => 'GET', 'route' => ['professor.subjects', $teacher->ProfessorId]]) }}
                                        {{ Form::submit('Дисциплины', array('class' => 'btn btn-primary btn-block')) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => ['profdel', $teacher->ProfessorId], 'onsubmit' => 'return ConfirmDelete("преподавателя")')) }}
                                        {{ Form::submit('Удалить', array('class' => 'btn btn-danger')) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
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
                {!! Form::open(['method' => 'POST', 'route' => 'professor.room.process']) !!}
                <div class="modal-body">
                    <table class="table table-condensed table-striped">
                        <tr>
                            <td>ID</td>
                            <td>{!! Form::text('id', null, ['class' => 'form-control']) !!}</td>
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
                            <td>Тип обработки</td>
                            <td>
                                {!! Form::radio('p-type', 'search', false, ['id' => 'p-type-0']); !!}
                                {!! Form::label('p-type-0', 'Поиск'); !!}
                                <br>
                                {!! Form::radio('p-type', 'filtering', true, ['id' => 'p-type-1']); !!}
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
                            </td>
                        </tr>
                        <tr>
                            <td>Упорядочить по</td>
                            <td>
                                {!! Form::radio('order', 'ASC', true, ['id' => 'o-type-0']); !!}
                                {!! Form::label('o-type-0', 'Возростанию'); !!}
                                <br>
                                {!! Form::radio('order', 'DESC', false, ['id' => 'o-type-1']); !!}
                                {!! Form::label('o-type-1', 'Убыванию'); !!}
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
    <script src="{{ asset('js/script.js') }}"></script>
@endsection