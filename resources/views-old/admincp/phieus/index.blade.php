@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Sản phẩm')
@push('main') Trang chủ @endpush
@push('item') Phiếu chi thu @endpush
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
                                <h3 class="card-title">Phiếu chi thu</h3>
                                <div class="card-tools">
                                    <a class="btn btn-sm btn-primary" href="phieus/create"><i class="fas fa-plus"> </i> Tạo phiếu chi thu</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Phiếu</th>
                                            <th>Loại phiếu</th>
                                            <th>Ngày nhập</th>
                                            <th>Tiền phiếu chi thu</th>
                                            <th>Sắp xếp</th>
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
    <script src="admin_template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="admin_template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
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
                ajax: 'phieu',
                columns: [
                    {
                        data: 'id', width: '15px'
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'type', width: '200px'
                    },
                    {
                        data: 'date_import', width: '100px'
                    },
                    {
                        data: 'fee', className: 'text-center', width: '200px'
                    },
                    {
                        data: 'sort', className: 'text-center', width: '50px'
                    },
                    {
                        data: 'status', className: 'text-center', width: '10px'
                    },
                    {
                        data: 'action' , className: 'text-center', width: '100px'
                    }
                ],
                "columnDefs": [
                    { "targets": [2,3,4,5,6,7], "searchable": false }
                ],
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
        status('phieus');
        sort('phieus');
        destroy('phieus');
    </script>
@endpush
