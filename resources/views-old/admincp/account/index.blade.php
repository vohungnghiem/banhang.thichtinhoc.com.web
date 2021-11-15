@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Account')
@push('main') {{__('admin.home')}} @endpush
@push('item') {{__('admin.account')}} @endpush
@push('linkmain'){{'admincp'}}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">{{__('admin.list_account')}}</h3>
                                <div class="card-tools">
                                    <a class="btn btn-sm btn-primary" href="admincp/account/create"><i class="fas fa-plus"> </i> {{__('admin.create_account')}}</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('admin.name')}}</th>
                                            <th>{{__('admin.level')}}</th>
                                            <th>Email</th>
                                            <th>{{__('admin.phone')}}</th>
                                            <th>{{__('admin.avatar')}}</th>
                                            <th>{{__('admin.status')}}</th>
                                            <th class="text-center">{{__('admin.action')}}</th>
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
                ajax: 'user',
                columns: [
                    {
                        data: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'level'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'avatar'
                    },
                    {
                        data: 'status', className: 'text-center', width: '50px'
                    },
                    {
                        data: 'action' , className: 'text-center', width: '100px'
                    }
                ],
                "columnDefs": [{
                    "searchable": true,
                    "orderable": true,
                }],
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
        status('account');
        destroy('account');
    </script>
@endpush
