@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <div class="panel panel-default">

                    <div class="panel-body">

                        <h3>Предметы</h3>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Сокращение</th>
                                <th>Дисциплина</th>
                                <th>Кредиты</th>
                                <th>Преподаватель</th>
                                <th colspan="2" class="text-center">Инструменты</th>
                            </tr>
                            </thead>
                            <tbody>
                            <form   method="post" action="{{ URL::to('its/its_customs_office/create') }}" autocomplete="off">
                                <tr>
                                        <td><input class="input-sm" name="SubjectShortTitle"></td>
                                        <td><input class="input-sm" name="SubjectFullTitle"></td>
                                        <td><input class="input-sm" name="Credits"></td>
                                        <td>
                                            <select name="professor_id" class="form-control">
                                                @foreach($professors as $professor)
                                                <option value="{{$professor->ProfessorId}}}">{{$professor->Surname}} {{$professor->Name}}{{$professor->Patronymic}}</option>
                                                    @endforeach
                                            </select>
                                        </td>
                                        <td><a class="btn btn-default" href="{{"Добавить"}}" role="button">Добавить</a></td>
                            </form>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
                <a  class="button btn-default" href="{{route('subject')}}" role="button"> Список предметов</a>
            </div>
        </div>
    </div>
@endsection