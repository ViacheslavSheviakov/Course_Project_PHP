@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаватель</div>

                    <div class="panel-body">
                        <h3>
                            {{ $teacher->Surname }}
                            {{ $teacher->Name }}
                            {{ $teacher->Patronymic }}
                        </h3>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Предметы</div>

                    <div class="panel-body">
                        <ul>
                            @foreach($teacher->teachings as $teaching)
                                <li>{{ $teaching->SubjectShortTitle }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection