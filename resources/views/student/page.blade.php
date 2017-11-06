@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Students</div>

                <div class="panel-body">
                    <ul>
                        @foreach ($students as $student)
                            <li>{{$student->Surname}} {{$student->Name}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection