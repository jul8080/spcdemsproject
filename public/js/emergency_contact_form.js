$('#form_submit').on('submit', function (e) {
    e.preventDefault()

    $.ajax({
        url: $(this).attr('action'),
        method: $(this).attr('method'),
        data: new FormData(this),
        processData: false,
        cache: false,
        dataType: "json",
        contentType: false,

        success: function (data) {
            $('#message').html(data.message);
            setTimeout(() => {
                $('#message').text('');
            }, 5000);
        }
    });


 })
