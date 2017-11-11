@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"></div>

                    <div class="panel-body">
                        {{ Form::open(array('url' => 'groups')) }}
                        <table class="table table-striped">
                        <thead>
                        <tr>
                        <th>Группa {{$students[0]->GroupShortTitle}}</th>
                        </tr>
                        </thead>
                        <tr>
                        @foreach ($students as $student)
                        <tr>
                            <td
                                    id="id">{{ $student->RecordBookId }}
                            </td>
                            <td>
                            {{ Form::text('date',$student->EnteringDate, array('class' => 'form-control')) }}
                            </td>
                            <td>
                                {{ Form::text('Surname',$student->Surname, array('class' => 'form-control')) }}
                            </td>
                            <td>
                                {{ Form::text('Name',$student->Name, array('class' => 'form-control')) }}
                            </td>
                            <td>
                                {{ Form::text('Patronymic',$student->Patronymic, array('class' => 'form-control')) }}
                            </td>
                            <td>
                                <select id="chgroup" name="groupshorttitle" class="form-control">
                                    @foreach($groups as $group)
                                        <option value="{{$group->GroupShortTitle}}" @if($group->GroupShortTitle===$student->GroupShortTitle) selected @endif>{{$group->GroupShortTitle}}</option>
                                    @endforeach
                                </select>
                            </td>
                            </tr>
                        @endforeach
                        </tbody>
                        </table>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/script.js')}}"></script>
@endsection