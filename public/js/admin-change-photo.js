$(document).ready(function () {
    $('#upload_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            method: $(this).attr('method'),
            url: "/admin/change/photo",
            data: new FormData(this),
            dataType: "JSON",
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#message').html(data.message);
                $('#uploaded_image').html(data.uploaded_image);
            }
        });
    });


    $('#show').click(function () {
        $('#showForm').show()
    });
    $('#cancel').click(function () {
        $('#showForm').hide();
    });
    $('#close').click(function () {
        $('#showForm').hide();
    });
});
