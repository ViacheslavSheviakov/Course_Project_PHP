@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">Группa {{ $id }}</div>

                    <div class="panel-body">
                        <div class="alert alert-danger">
                            <p>В этой группе нет студентов и Вы можете ее удалить</p>
                        </div>
                    </div>

                    <div class="panel-footer">
                        {!! Form::open(['method' => 'DELETE', 'route' => ['delgroup', $id], 'onsubmit' => 'return ConfirmDelete("группу")']) !!}
                        {!! Form::submit('Удалить', ['class' => 'btn btn-danger','data-toggle'=>'confirmation', 'data-title'=>'Delete','data-content'=>'Delete group' ]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
@endsection