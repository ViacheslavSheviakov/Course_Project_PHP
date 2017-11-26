@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление дисциплины</div>

                    <div class="panel-body">
                        {{ Form::open(array('route' => 'subjectAdded')) }}
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Сокращение</th>
                                <th>Дисциплина</th>
                                <th>Кредиты</th>
                                <th>Инструменты</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    {{ Form::text('SubjectShortTitle', null, array('class' => 'form-control')) }}</td>
                                <td>{{ Form::text('SubjectFullTitle', null, array('class' => 'form-control')) }}</td>
                                <td>
                                    {{ Form::selectRange('Credits', 1, 7, 3, array('class' => 'form-control')) }}
                                </td>
                                <td>
                                    {{ Form::submit('Добавить', array('class' => 'btn btn-success btn-block')) }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {{ Form::close() }}
                        <br>
                    </div>
                </div>
                <a class="btn btn-default" href="{{route('subject')}}" role="button"> Список предметов</a>
            </div>
        </div>
    </div>
@endsection