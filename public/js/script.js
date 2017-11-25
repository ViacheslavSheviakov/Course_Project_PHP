// $.get('/studentedit', function(){
//     console.log('response');
// });


$(document).on('change', '#chgroup', function (e) {

    var id = $( this ).parent().parent().find("#id").html();
<<<<<<< HEAD
   alert(id);
   alert( this.value );
=======
   //alert(id);
   //alert( this.value );
>>>>>>> f35312c79c5c3c42c26183149dae3fdd4aef53fc
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
<<<<<<< HEAD
        url: "groups/ajaxgroup",
=======
        url: "studenteditor/ajaxgroup",
>>>>>>> f35312c79c5c3c42c26183149dae3fdd4aef53fc
        cache: false,
            data: {'RecordBookId': id, "val":  this.value}, // если нужно передать какие-то данные
        type: "POST", // устанавливаем типа запроса POST
        success: function (data) {
            //alert('ok');
        }
    })
        .done(function( msg ) {
<<<<<<< HEAD
       alert( msg )
=======
       // alert( msg )
>>>>>>> f35312c79c5c3c42c26183149dae3fdd4aef53fc
        });
});