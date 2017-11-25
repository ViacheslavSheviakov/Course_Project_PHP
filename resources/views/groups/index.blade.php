@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Группы</div>

                    <div class="panel-body">
                        {{ Form::open(array('url' => 'groups')) }}

                        <table class="table table-striped">
                            @foreach ($groups as $group)
                                <tr>
                                    <td>
                                        <a class="button btn-default"
                                           href="{{action('GroupsEditorController@group', ['id' => $group->GroupShortTitle])}}"
                                           role="button">{{$group->GroupShortTitle}}
                                            {{$group->GroupFullTitle}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection