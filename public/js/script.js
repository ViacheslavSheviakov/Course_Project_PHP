$(document).on('change', '#chgroup', function (e) {

    var id = $( this ).parent().parent().find("#id").html();
    //alert(id);
    //alert( this.value );
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "studenteditor/ajaxgroup",
        cache: false,
        data: {'RecordBookId': id, "val":  this.value}, // если нужно передать какие-то данные
        type: "POST", // устанавливаем типа запроса POST
        success: function (data) {
            //alert('ok');
        }
    })
        .done(function( msg ) {
            // alert( msg )
        });
});

$(document).on('change', '#chgroup', function (e) {

    var id = $( this ).parent().parent().find("#id").html();
    //alert(id);
    //alert( this.value );
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "groups/ajaxgroup",
        cache: false,
        data: {'RecordBookId': id, "val":  this.value}, // если нужно передать какие-то данные
        type: "POST", // устанавливаем типа запроса POST
        success: function (data) {
            //alert('ok');
        }
    })
        .done(function( msg ) {
            //alert( msg )
        });
});

$(document).on('click', '#btngrade', function (e)
{
    var RecordBookId = $( this ).parent().parent().find("#id").html();
    var scheduleid = $( "#scheduleid" ).html();
    var grade = $( this ).parent().parent().find("#grade")[0].value;
      //alert(grade);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "ajaxgrades",
        cache: false,
        data: {'RecordBookId': RecordBookId, "ScheduleId":  scheduleid, "Grade": grade}, // если нужно передать какие-то данные
        type: "POST", // устанавливаем типа запроса POST
        success: function (data) {
            //alert('ok');
        }
    })
        .done(function( msg ) {
           // alert( msg )
        });
});