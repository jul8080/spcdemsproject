$(document).ready(function () {
    $('#registrationForm').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,

            success: function (data) {
                if(data.status === 1)
                {
                    $('#registrationForm')[0].reset()
                    $('#message').text(data.success);
                    setTimeout(()=>{
                        $('#message').text('');
                    }, 5000);
                    console.log(data.success);

                } else {
                    $('#school_id').html(data.fail[0]);

                    $.each(data.fail, function (i, error) {
                        $('#error-' + i).text(error);
                        setTimeout(()=>{
                            $('#error-' + i).text('');
                        }, 5000);
                        console.log(i,error);
                    });
                }
            }
        });
    });



    $('#add-employee').click(function (e) {
        e.preventDefault();
        $('#registration-wrapper').animate({
            'right':'0'
        }, 'fast');
    });

    $('#cancel-form').click(function (e) {
        e.preventDefault();
        $('#registration-wrapper').animate({
            'right':'-50rem'
        }, 'fast');
    });
});
