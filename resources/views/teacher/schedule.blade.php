@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3>Студент</h3></div>

                    {{--<div class="panel-body">--}}
                        {{--<h3>{{ $data[0]->Surname }} {{ $data[0]->Name }}</h3>--}}
                        {{--<h4>Группа: {{ $data[0]->GroupShortTitle }}</h4>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading"><h3>Рассписание</h3></div>--}}

                    {{--<div class="panel-body">--}}
                        {{--<div class="schedule">--}}
                            {{--@foreach($data[1] as $date => $lessons)--}}
                                {{--<div class="day">--}}
                                    {{--<h3>{{ $date }}</h3>--}}
                                    {{--@for($i = 0; $i < 8; $i++)--}}
                                        {{--<div class="lesson">--}}
                                            {{--@if(isset($lessons[$i]))--}}
                                                {{--<span class="lesson-type">{{ $lessons[$i][0] }}</span>--}}
                                                {{--<span class="subject-title">{{ $lessons[$i][1] }}</span>--}}
                                            {{--@endif--}}
                                        {{--</div>--}}
                                    {{--@endfor--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

