$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function sendEmail() {
    let email = $('#exampleInputEmail1').val();
    console.log(email);
    $.ajax({
    url: '/api/beginCheck',         /* Куда пойдет запрос */
    method: 'post',             /* Метод передачи (post или get) */
    dataType: 'html',          /* Тип данных в ответе (xml, json, script, html). */
    data: {
        email: email
    },
    success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
        console.log(data);            /* В переменной data содержится ответ от index.php. */
        }
    });
}