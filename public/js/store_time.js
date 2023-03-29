$(document).ready(function () {

    $('#send_form').on('submit', function (e) {
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
                if(data.status == 0)
                {
                    $('#message').html(data.message);
                } else {
                    $('#showTimeInForm').css({
                        'display':'none'
                    });
                    $('#timeInCancelBtn').hide();
                }
            },
        });
     })


     $('#timeIn').click(function (e) {
        e.preventDefault();
        $().show();
        $('#showTimeInForm').css({
            'display':'flex'
        });
        $('#timeInCancelBtn').show();
    });

    // hide time in form
    $('#timeInCancelBtn').click(function (e) {
        e.preventDefault();
        $().show();
        $('#showTimeInForm').css({
            'display':'none'
        });
        $('#timeInCancelBtn').hide();
    });

    // show time out form
    $('#timeOut').click(function (e) {
        e.preventDefault();
        $().show();
        $('#showTimeOutForm').css({
            'display':'flex'
        });
        $('#timeOutCancelBtn').show();
    });
    // hide time out form
    $('#timeOutCancelBtn').click(function (e) {
        e.preventDefault();
        $().show();
        $('#showTimeOutForm').css({
            'display':'none'
        });
        $('#timeOutCancelBtn').hide();
    });

});
