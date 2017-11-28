@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Выбор преподавателя</div>
                    <div class="panel-body">
                        <table class="table table-striped">
                            <tr>
                                <th>ФИО</th>
                                <th>Дисциплины</th>
                                <th>Действие</th>
                            </tr>
                            @foreach($professors as $professor)
                                <tr>
                                    <td>
                                        {{  $professor->Surname }}
                                        {{  $professor->Name }}
                                        {{  $professor->Patronymic }}
                                    </td>
                                    <td>
                                        <ul class="list-group">
                                            @foreach($professor->teachings as $teaching)
                                                <li class="list-group-item">{{ $teaching->SubjectShortTitle }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        {!! Form::open(['method' => 'GET', 'route' => ['schedule-step-2']]) !!}
                                        {!! Form::hidden('id',$professor->ProfessorId, array('class' => 'form-control')) !!}
                                        {!! Form::submit('Выбрать', ['class' => 'btn btn-default']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection