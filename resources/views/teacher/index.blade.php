@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватели</div>

                    <div class="panel-body">
                        {{ Form::open(array('url' => 'teacher')) }}
                        <table class="table table-striped">
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Действие</th>
                            </tr>
                            <tr>

                                {{ Form::hidden('id',$teacher->ProfessorId, array('class' => 'form-control')) }}

                                <td>
                                    {{ Form::text('Surname',$teacher->Surname, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::text('Name',$teacher->Name, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::text('Patronymic',$teacher->Patronymic, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::submit('Изменить', array('class' => 'btn btn-success btn-block')) }}
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