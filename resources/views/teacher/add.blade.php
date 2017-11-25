@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватели</div>

                    <div class="panel-body">
                        {{ Form::open(array('url' => '/professor/add', 'method' => 'POST')) }}
                        <table class="table table-striped">
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>E-mail</th>
                                <th>Действие</th>
                            </tr>
                            <tr>
                                <td>
                                    {{ Form::text('Surname', '', array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::text('Name', '', array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::text('Patronymic', '', array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::text('Email', '', array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::submit('Добавить', array('class' => 'btn btn-success btn-block')) }}
                                </td>
                            </tr>
                        </table>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection