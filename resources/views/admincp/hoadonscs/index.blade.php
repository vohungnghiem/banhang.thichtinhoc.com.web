@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Hóa đơn sửa chửa')
@push('main') Trang chủ @endpush
@push('item') Hóa đơn sửa chửa @endpush
@push('linkmain'){{'/'}}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">hóa đơn sửa chửa</h3>
                                <div class="card-tools">
                                    <a class="btn btn-sm btn-primary" href="hoadonscs/create"><i class="fas fa-plus"> </i> Tạo hóa đơn sửa chửa</a>
                                </div>
                            </div>
                            <div class="card-body" style="overflow:auto;">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" width="100%" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Mã hóa đơn</th>
                                            <th>Thời gian</th>
                                            <th>Ngày trả</th>
                                            <th>Tên thiết bị</th>
                                            <th>Tên khách hàng</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Sửa chửa + bán hàng</th>
                                            <th>Công nợ</th>
                                            <th>Trạng thái</th>
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

@endsection
@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="admin_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        img {max-width:100% !important;}
    </style>
@endpush
@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="admin_template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    {{-- <script src="admin_template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="admin_template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> --}}
    <script>
        $(function() {
            $.fn.dataTable.ext.errMode = 'throw';
            $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                ajax: 'hoadonsc',
                columns: [
                    {
                        data: 'id', width: '15px'
                    },
                    {
                        data: 'mahoadon', width: '100px'
                    },
                    {
                        data: 'thoigian', width: '100px'
                    },
                    {
                        data: 'ngaytra', width: '100px'
                    },
                    {
                        data: 'tentb'
                    },
                    {
                        data: 'tenkh'
                    },
                    {
                        data: 'diachi'
                    },
                    {
                        data: 'sdt', width: '150px'
                    },
                    {
                        data: 'tongtien', className: 'text-center', width: '150px'
                    },
                    {
                        data: 'congno', className: 'text-center'
                    },
                    {
                        data: 'status', className: 'text-left', width: '10px'
                    },
                    {
                        data: 'action' , className: 'text-left', width: '100px'
                    }
                ],
                // "columnDefs": [
                //     { "targets": [2,3,4,5,6,7], "searchable": false }
                // ],
                "ordering": false,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndexFull + 1;
                    $('td:eq(0)', nRow).html(index);
                    return nRow;
                },
                search: {
                    "regex": true
                },
            });
        });


    </script>
    <script>
        morestatus('hoadonscs');
        sort('hoadonscs');
        destroy('hoadonscs');
    </script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-loinhuan', function(event) {
                var index = $(this).parent().parent().index();
                if( $('.form-loinhuan:eq('+index+')').css('display') == "none" )  {
                    $('.form-loinhuan:eq('+index+')').css("display", "flex");
                }
                else {
                    $('.form-loinhuan:eq('+index+')').css("display", "none");
                }
            });
        });
        $(document).ready(function () {
            $(document).on('click', '.btn-ghichu', function(event) {
                var index1 = $(this).parent().parent().index();
                if( $('.form-ghichu:eq('+index1+')').css('display') == "none" )  {
                    $('.form-ghichu:eq('+index1+')').css("display", "flex");
                }
                else {
                    $('.form-ghichu:eq('+index1+')').css("display", "none");
                }
            });
        });
        $(document).ready(function(){
            $(document).on('click', '.click .copy', function(event) {
                var $tempElement = $("<input>");
                $("body").append($tempElement);
                $tempElement.val($(this).closest(".click").find("span").text('đã coppy').attr('link')).select();
                document.execCommand("Copy");
                $tempElement.remove();
            });
        });
    </script>
@endpush
