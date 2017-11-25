@extends('layouts.app')

@section('content')
    @role('Admin')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Панель управления</div>

                    <div class="panel-body">
                        <a href="groups" class="btn btn-default">Группы</a>
                        <a href="studenteditor" class="btn btn-default">Студенты</a>
                        <a href="subject" class="btn btn-default">Предметы</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole
@endsection