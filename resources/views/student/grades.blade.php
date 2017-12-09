@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Оценки</div>

                    <div class="panel-body">

                        {!! Form::open(['method' => 'POST', 'route' => 'report']) !!}
                        <div class="btn-group-vertical">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#settings"
                                    onclick="return false;">
                                Настрйки поиска
                            </button>
                            {!! Form::submit('Скачать Отчёт', ['class' => 'btn btn-primary']) !!}
                        </div>
                        {!! Form::close(); !!}
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed">
                                <tr>
                                    <th>Дата</th>
                                    <th>Дисциплина</th>
                                    <th>Тип занятия</th>
                                    <th>Преподаватель</th>
                                    <th>Оценка</th>
                                </tr>
                                @foreach($grades as $grade)
                                    <tr>
                                        <td>{{ (new \DateTime($grade->LessonDate))->format('d.m.Y') }}</td>
                                        <td>{{ $grade->SubjectShortTitle }}</td>
                                        <td>{{ $grade->LessonType }}</td>
                                        <td>
                                            {{ $grade->Surname }}
                                            {{ $grade->Name }}
                                            {{ $grade->Patronymic }}
                                        </td>
                                        <td><i>{{ $grade->Grade }}</i></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
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
                {!! Form::open(['method' => 'POST', 'route' => 'student.grades.process']) !!}
                <div class="modal-body">
                    <table class="table table-condensed table-striped">
                        <tr>
                            <td>Дата c</td>
                            <td>{!! Form::date('date-from', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Дата по</td>
                            <td>{!! Form::date('date-to', null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Тип занятия</td>
                            <td>{!! Form::select('lesson-type', collect([null => '-'])->merge(\App\LessonType::all()->pluck('TypeShortTitle', 'TypeShortTitle')), null, ['class' => 'form-control']) !!}</td>
                        </tr>
                        <tr>
                            <td>Оценка</td>
                            <td>{!! Form::text('grade', null, ['class' => 'form-control']) !!}</td>
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
                                {!! Form::checkbox('s-type[]', 'LessonDate', false, ['id' => 's-type-0']); !!}
                                {!! Form::label('s-type-0', 'Дата'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'SubjectShortTitle', false, ['id' => 's-type-0']); !!}
                                {!! Form::label('s-type-0', 'Предмет'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'LessonType', false, ['id' => 's-type-1']); !!}
                                {!! Form::label('s-type-1', 'Тип занятия'); !!}
                                <br>
                                {!! Form::checkbox('s-type[]', 'Grade', false, ['id' => 's-type-2']); !!}
                                {!! Form::label('s-type-2', 'Оценка'); !!}
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