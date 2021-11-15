$(function() {
    var url = window.location + "";
    var path = url.replace(window.location.protocol + "//" + window.location.host + "/", "");
    var res = path.split("/");
    if (path == "") {
        $('#dashboard').addClass('active');
    }
    if ((res[3]) == 'list') {
        $('#category').addClass('active');
    }
    $(".nav-link").each(function() {
        if ((res[0]) == $(this).attr('href')) {
            $(this).addClass('active');
            $(this).parents('li').addClass('menu-open');
        }
        if ((res[0] + '/' + res[1]) == $(this).attr('href')) {
            $(this).addClass('active');
            $(this).parents('li').addClass('menu-open');
        }

        if ((res[0] + '/' + res[1] + '/' + res[2]) == $(this).attr('href') + '/undefined') {
            $(this).addClass('active');
            $(this).parents('li').addClass('menu-open');
        }
    });
});