@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление группы</div>

                    <div class="panel-body">
                        {{ Form::open(['method' => 'POST', 'route' => 'addTeacher']) }}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>GroupShortTitle</th>
                                <th>GroupFullTitle</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ Form::text('GroupShortTitle', null, array('class' => 'form-control')) }}</td>
                                <td>{{ Form::text('GroupFullTitle', null, array('class' => 'form-control')) }}</td>
                                <td>
                                    {{ Form::submit('Добавить в группу преподавателя', array('class' => 'btn btn-success btn-block')) }}
                                </td>
                                {{--<td>--}}
                                    {{--{{ Form::submit('Добавить группу', array('class' => 'btn btn-success btn-block')) }}--}}
                                {{--</td>--}}
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection