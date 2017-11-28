@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватель</div>
                    <div class="panel-body">
                        <h3>
                            {{ $professor->Surname }}
                            {{ $professor->Name }}
                            {{ $professor->Patronymic }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Группа</div>
                    <div class="panel-body">
                        <h3>{{ $group}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Дата</div>
                    <div class="panel-body">
                        <h3>{{ $date}}</h3>
                        <h3 id="scheduleid" hidden="true">{{$scheduleid}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Оценки</div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Номер<br> зачетки</th>
                                <th>Студент</th>
                                <th>Оценка</th>
                            </tr>
                            @foreach($students as $student)
                                <tr>
                                    <td id="id">{{ $student->RecordBookId }}</td>
                                    <td><i>{{ $student->Surname }} {{ $student->Name }} {{ $student->Patronymic }}</i></td>
                                    <td>
                                        <input id="grade"  class="form-control" type="number" min="0" max="100" value=
                                        @foreach($grades as $grade)
                                        @if($grade->RecordBookId===$student->RecordBookId) {{$grade->Grade}} @endif
                                        @endforeach >
                                    </td>
                                    {{--<td>{{Form::number('grade',null,['min'=>0,'max'=>100],array('class' => 'form-control'))}}</td>--}}
                                    <td><a id="btngrade" class="btn btn-success" role="button">Применить</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
@endsection