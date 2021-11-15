// tooltip
$('body').tooltip({
    selector: '[data-toggle="tooltip"]'
});
$('body').popover({
    selector: '[data-toggle="popover"]'
});
$('.select2bs4').select2({
    theme: 'bootstrap4'
});
// check swith
$("input[data-bootstrap-switch]").each(function() {
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
});
// scroll nutluu
$(document).scroll(function() {
    var scroll_pos = $(window).scrollTop();
    if (scroll_pos > 125) {
        $('.nutluu').css({ "position": "fixed", "right": "15px", "top": "10px", "z-index": "999" });
    } else {
        $('.nutluu').css({ "position": "sticky" });
    }
});