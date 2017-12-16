@extends('layouts.app')

@section('content')
    @role('Admin')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление дисциплины</div>

                    <div class="panel-body">
                        <h3 class="h3">{{ $professor->Surname }} {{ $professor->Name }} {{ $professor->Patronymic }}</h3>
                        <br>
                        {!! Form::open([
                            'method' => 'POST',
                            'route' => 'professor.subject.add'
                        ]) !!}
                        {!! Form::hidden('professor-id', $professor->ProfessorId, array('class' => 'form-control')) !!}
                        <div class="form-group">
                            {{ Form::label('Новая дисциплина') }}
                            {{ Form::select('new-subject', $subjects->pluck('SubjectShortTitle', 'SubjectShortTitle'), false, array('class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::submit('Добавить', array('class' => 'btn btn-success')) }}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Преподаваемые дисциплины</div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped">
                                <tr>
                                    <th>Аббр.</th>
                                    <th>Название</th>
                                    <th>Действие</th>
                                </tr>
                                @foreach($teachings as $teaching)
                                    <tr>
                                        <td>{{ $teaching->SubjectShortTitle }}</td>
                                        <td>{{ $teaching->subject->SubjectFullTitle }}</td>
                                        <td>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => [
                                                    'professor.subject.delete',
                                                    $professor->ProfessorId,
                                                    $teaching->TeachingId],
                                                'onsubmit' => 'return ConfirmDelete("дисциплину")'
                                            ]) !!}
                                            {!! Form::submit('Удалить', array('class' => 'btn btn-danger')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
    @endrole
@endsection