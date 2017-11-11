// $.get('/studentedit', function(){
//     console.log('response');
// });


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
       alert( msg )});
});