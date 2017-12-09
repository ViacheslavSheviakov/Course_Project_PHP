@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        {{ Form::open(array('url' => 'teacher')) }}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="font-family: 'Britannic Bold'">

                                {{ Form::hidden('id',$teacher->ProfessorId, array('class' => 'form-control')) }}

                                <td><b>
                                    {{ Form::text('Surname',$teacher->Surname, array('class' => 'form-control')) }}
                                    </b>
                                </td>
                                <td>
                                    {{ Form::label('Name',$teacher->Name, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::label('Patronymic',$teacher->Patronymic, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::submit('Изменить', array('class' => 'btn btn-success btn-lg btn-block')) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                    </div>
                    {{--<button click="location.href='{{ url('schedule.blade.php') }}'">--}}
                        {{--Check Stock</button>--}}
                    <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection