@extends('layouts.app')

@section('content')
    @role('Admin')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Панель управления</div>

                    <div class="panel-body">
                        <a href="groups" class="btn btn-default btn-block">Группы</a>
                        <a href="studenteditor" class="btn btn-default btn-block">Студенты</a>
                        <a href="subject" class="btn btn-default btn-block">Предметы</a>
                        <a href="professor/edit" class="btn btn-default btn-block">Преподаватели</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection