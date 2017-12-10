@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        {{--{{ Form::open(['method' => 'POST', 'route' => 'addGroup'], array('url' => 'teachers')) }}--}}
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
                                    {{ Form::label('Surname',$teacher->Surname, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::label('Name',$teacher->Name, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::label('Patronymic',$teacher->Patronymic, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::open(['method' => 'POST', 'route' => 'addGroup'], array('url' => 'teachers')) }}
                                    {{ Form::hidden('GroupShortTitle',$teacher->GroupShortTitle, array('class' => 'form-control')) }}
                                    {{ Form::hidden('GroupFullTitle',$teacher->GroupFullTitle, array('class' => 'form-control')) }}
                                    {{ Form::hidden('ProfessorId',$teacher->ProfessorId, array('class' => 'form-control')) }}
                                    {{ Form::submit('Добавить в группу', array('class' => 'btn btn-success btn-lg btn-block')) }}
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