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
                                    @foreach($subjects as $subject)
                                        <td><input class="input-sm" name="SubjectShortTitle" value="{{ $subject->SubjectShortTitle }}"></td>
                                        <td><input class="input-sm" name="SubjectFullTitle" value="{{ $subject->SubjectFullTitle }}"></td>
                                        <td><input class="input-sm" name="Credits" value="{{ $subject->Credits }}"></td>
                                        <td><input class="input-sm" name="Credits" value="{{ "Преподаватель" }}"></td>
                                    <td><a class="btn btn-default" href="{{route('subjectEdit',['id'=>$subject->SubjectShortTitle])}}" role="button">Изменить</a></td>
                                    <td><a class="btn btn-default" href="{{route('subjectDel',['del'=>$subject->SubjectShortTitle])}}" role="button">Удалить</a></td>
                                @endforeach
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