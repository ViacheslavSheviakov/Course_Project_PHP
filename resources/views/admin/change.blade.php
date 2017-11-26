@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Персональные данные</div>

                    <div class="panel-body">
                        @if ($errors != null && $errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h3>
                            {{ Form::open(array('url' => 'edit', 'method' => 'POST')) }}
                            <div class="form-group">
                                {{ Form::label('E-mail') }}
                                {{ Form::email('email', Auth::user()->email, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Пароль') }}
                                {{ Form::password('pass', array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('Повторите пароль') }}
                                {{ Form::password('pass-conf', array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                {{ Form::submit('Изменить', array('class' => 'btn btn-primary')) }}
                                {{ Form::close() }}
                            </div>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection