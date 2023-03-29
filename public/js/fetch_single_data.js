$(document).ready(function () {
    $(function(e){
        $.ajax({
            type: "GET",
            url: "/user/profile",
            // processData: false,
            // cache: false,
            // contentType: false,
            success: function (response) {
            console.log(response.user);
            }
        });
    })

});
