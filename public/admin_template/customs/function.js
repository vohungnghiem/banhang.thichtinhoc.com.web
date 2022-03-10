// token
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// change status
function status(params) {
    $("#myTable").on('click', '.btn-status', function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.revert,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.change,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                $.post(params + "/status", {
                        id: id
                    },
                    function(result) {
                        swal_condition(result);
                    }
                );
            }
        });
    });
}
// change status
function morestatus(params) {
    $("#myTable").on('click', '.btn-status', function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.revert,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.change,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                $.post(params + "/status", {
                        id: id,
                        status: status
                    },
                    function(result) {
                        console.log(result);
                        swal_condition(result);
                    }
                );
            }
        });
    });
}
// change status
function congno(params) {
    $("#myTable").on('click', '.btn-congno', function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.revert,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.change,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                var date = $(this).attr('data-date');
                var loai = $(this).attr('data-loai');
                $.post(params + "/congno", {
                        id: id,
                        date: date,
                        loai: loai
                    },
                    function(result) {
                        swal_condition(result);
                    }
                );
            }
        });
    });
}
// change sort
function sort(params) {
    $("#myTable").on('change', '.btn-sort', function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.revert,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.change,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                var sort = $(this).val();
                $.post(params + "/sort", {
                        id: id,
                        sort: sort
                    },
                    function(result) {
                        swal_condition(result);
                    }
                );
            }
        });
    });
}
// remove image
function xoaImg(params) {
    $('#remove_img').click(function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.remove_img,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.delete,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                $.post(params + "/remove_img", {
                        id: id
                    },
                    function(result) {
                        swal_condition(result);
                    }
                );
            }
        });
    });
}
// remove image
function xoaImgLocation(params) {
    $('#remove_img_location').click(function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.remove_img,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.delete,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                $.post(params + "/remove_img_location", {
                        id: id
                    },
                    function(result) {
                        swal_condition(result);
                    }
                );
            }
        });
    });
}
// call back swal
function swal_condition(result) {
    if (result == 'success') {
        Swal.fire({
            title: lang.alert.success,
            text: lang.alert.change_success,
            icon: 'success',
            confirmButtonText: lang.alert.ok,
            timer: 1000,
        }).then((data) => {
            location.reload();
        });
    } else if (result == 'warning') {
        Swal.fire({
            title: lang.alert.warning,
            text: lang.alert.change_warning,
            icon: 'warning',
            confirmButtonText: lang.alert.ok,
            timer: 1000,
        }).then((data) => {
            location.reload();
        });
    } else if (result == 'permission') {
        Swal.fire({
            title: lang.alert.warning,
            text: lang.alert.permission,
            icon: 'warning',
            confirmButtonText: lang.alert.ok,
            timer: 1000,
        }).then((data) => {
            location.reload();
        });
    } else {
        Swal.fire({
            title: lang.alert.error,
            text: lang.alert.change_error,
            icon: 'error',
            confirmButtonText: lang.alert.ok,
            timer: 1000,
        }).then((data) => {
            location.reload();
        });
    }
}
// remove
function destroy(params) {
    $("#myTable").on('click', '.btn-destroy', function(e) {
        Swal.fire({
            // position: 'top-end',
            title: lang.alert.question_ays,
            text: lang.alert.revert,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: lang.alert.delete,
            cancelButtonText: lang.alert.cancel
        }).then((result) => {
            if (result.isConfirmed) {
                var id = $(this).attr('data-id');
                $.post(params + "/destroy", {
                        id: id
                    },
                    function(result) {
                        if (result == 'success') {
                            Swal.fire({
                                title: lang.alert.success,
                                text: lang.alert.delete_success,
                                icon: 'success',
                                confirmButtonText: lang.alert.ok,
                            }).then((data) => {
                                location.reload();
                            });
                        } else if (result == 'warning') {
                            Swal.fire({
                                title: lang.alert.warning,
                                text: lang.alert.change_warning,
                                icon: 'warning',
                                confirmButtonText: lang.alert.ok,
                            }).then((data) => {
                                location.reload();
                            });
                        } else if (result == 'permission') {
                            Swal.fire({
                                title: lang.alert.warning,
                                text: lang.alert.permission,
                                icon: 'warning',
                                confirmButtonText: lang.alert.ok,
                            }).then((data) => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: lang.alert.error,
                                text: lang.alert.delete_error,
                                icon: 'error',
                                confirmButtonText: lang.alert.ok,
                            }).then((data) => {
                                location.reload();
                            });
                        }
                    }
                );
            }
        });
    });
}