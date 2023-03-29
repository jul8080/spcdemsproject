$(document).ready(function () {

    // department update button
    $('#role-edit').click(function (e) {
        e.preventDefault();


        $('#change-role').animate({
            'height': '112px',
        },'fast');
        $('#role-update').show();
        $('#role-edit').hide();

        $('#change-entry').animate({
            'height': '0px',
        },'fast');
        $('#entry-edit').show();
        $('#entry-update').hide();

        $('#change-status').animate({
            'height': '0px',
        },'fast');
        $('#status-update').hide();
        $('#status-edit').show();

        $('#close-container').css({'border-top-width':'1px', 'display':'block', 'height':'40px'});
        $('#close-form').show();
    });
    // status edit
    $('#status-edit').click(function (e) {
        e.preventDefault();
        $('#change-status').animate({
            'height': '112px',
        },'fast');
        $('#status-update').show();
        $('#status-edit').hide();

        $('#change-role').animate({
            'height': '0px',
        },'fast');
        $('#role-update').hide();
        $('#role-edit').show();

        $('#change-entry').animate({
            'height': '0px',
        },'fast');
        $('#entry-edit').show();
        $('#entry-update').hide();

        $('#close-container').css({'border-top-width':'1px', 'display':'block', 'height':'40px'});
        $('#close-form').show();

    });

    // position edit button

    $('#entry-edit').click(function (e) {
        e.preventDefault();
        $('#change-entry').animate({
            'height': '112px',
        },'fast');
        $('#entry-edit').hide();
        $('#entry-update').show();

        $('#change-role').animate({
            'height': '0px',
        },'fast');
        $('#role-edit').show();
        $('#role-update').hide();

        $('#change-status').animate({
            'height': '0px',
        },'fast');
        $('#status-update').hide();
        $('#status-edit').show();

        $('#close-container').css({'border-top-width':'1px', 'display':'block', 'height':'40px'});
        $('#close-form').show();
    });


    // close form role & entry level for user
    $('#close-form').click(function (e) {
        e.preventDefault();
        $('#change-role').animate({
            'height': '0px',
        },'fast');
        $('#role-update').hide();
        $('#role-edit').show();

        $('#change-entry').animate({
            'height': '0px',
        },'fast');
        $('#entry-edit').show();
        $('#entry-update').hide();

        $('#close-form').hide();

        $('#change-status').animate({
            'height': '0px',
        },'fast');
        $('#status-update').hide();
        $('#status-edit').show();

        $('#close-container').css({'border-top-width':'0px', 'display':'hidden', 'height':'0px'});

    });

    $('#close-wrapper').click(function (e) {
        e.preventDefault();
        $('#wrapper').hide();
        $('#change-role').animate({
            'height': '0px',
        },'fast');

        $('#change-status').animate({
            'height': '0px',
        },'fast');
        $('#status-update').hide();
        $('#status-edit').show();

        $('#role-edit').show();
        $('#role-update').hide();
        $('#change-entry').animate({
            'height': '0px',
        },'fast');
        $('#entry-edit').show();
        $('#entry-update').hide();

        $('#close-form').hide();
        $('#close-container').css({'border-top-width':'0px', 'display':'hidden', 'height':'0px'});
    });
});
