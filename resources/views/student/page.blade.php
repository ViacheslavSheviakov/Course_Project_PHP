
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Студент</div>

                <div class="panel-body">
                    <h2>{{ $data[0]->Surname }} {{ $data[0]->Name }}</h2>
                    <h4>{{ $data[0]->GroupShortTitle }}</h4>
                    <hr>
                    <h3>Рассписание</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Номер Пары</th>
                                <th>Дисциплина</th>
                                <th>Тип занятия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data[1] as $element)
                                <tr>
                                    <td>{{ $element->LessonDate }}</td>
                                    <td>{{ $element->LessonNumber }}</td>
                                    <td>{{ $element->SubjectShortTitle }}</td>
                                    <td>{{ $element->LessonType }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br>
                    <h3>Оценки</h3>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Дисциплина</th>
                            <th>Преподователь</th>
                            <th>Оценка</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data[2] as $element)
                            <tr>
                                <td>{{ $element->LessonDate }}</td>
                                <td>{{ $element->SubjectShortTitle }}</td>
                                <td>{{ $element->Surname }} {{ $element->Name }} {{ $element->Patronymic }}</td>
                                <td>{{ $element->Grade }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

