@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватели</div>

                    <div class="panel-body">
                        <a href="add" class="btn btn-success">Добавить</a>
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
                                        {{ Form::open(array('url' => 'profedit')) }}
                                        {{ Form::hidden('id',$teacher->ProfessorId, array('class' => 'form-control')) }}
                                        {{ Form::submit('Изменить', array('class' => 'btn btn-primary btn-block')) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                        {{ Form::open(array('method' => 'DELETE', 'route' => ['profdel', $teacher->ProfessorId], 'onsubmit' => 'return ConfirmDelete()')) }}
                                        {{ Form::submit('Удалить', array('class' => 'btn btn-danger btn-block')) }}
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
    <script>

        function ConfirmDelete() {
            var x = confirm("Вы уверены, что хотите удалить этого преподавателя?");
            if (x)
                return true;
            else
                return false;
        }

    </script>
@endsection