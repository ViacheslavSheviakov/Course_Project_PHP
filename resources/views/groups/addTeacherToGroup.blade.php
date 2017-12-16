@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                            <tr>
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
                                    {{ Form::open(['method' => 'POST', 'route' => 'addGroup'], array('url' => 'teachers')) }}
                                    {{ Form::hidden('GroupShortTitle',$teacher->GroupShortTitle, array('class' => 'form-control')) }}
                                    {{ Form::hidden('GroupFullTitle',$teacher->GroupFullTitle, array('class' => 'form-control')) }}
                                    {{ Form::hidden('ProfessorId',$teacher->ProfessorId, array('class' => 'form-control')) }}
                                    {{ Form::submit('Добавить в группу', array('class' => 'btn btn-success btn-block')) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
