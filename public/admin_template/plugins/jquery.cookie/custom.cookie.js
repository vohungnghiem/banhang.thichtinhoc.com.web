$(document).ready(function() {
    var remember = $.cookie('rememberadmin');
    if (remember == 'true')
    {
        var email = $.cookie('emailadmin');
        var password = atob($.cookie('passwordadmin'));
        $('#email').val(email);
        $('#password').val(password);
        $('#remember').prop('checked', true);
    }
    $("#login").submit(function() {
        if ($('#remember').is(':checked')) {
            var email = $('#email').val();
            var password = btoa($('#password').val());
            $.cookie('emailadmin', email, { expires: 365 });
            $.cookie('passwordadmin', password, { expires: 365 });
            $.cookie('rememberadmin', true, { expires: 365 });
        }
        else
        {
            $.cookie('emailadmin', null);
            $.cookie('passwordadmin', null);
            $.cookie('rememberadmin', null);
        }
    });

    $("#reset").click(function() {
        $.cookie('emailadmin', null);
        $.cookie('passwordadmin', null);
        $.cookie('rememberadmin', null);
    });
});
