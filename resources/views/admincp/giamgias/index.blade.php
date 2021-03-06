@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Giảm giá')
@push('main') Trang chủ @endpush
@push('item') Giảm giá @endpush
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
                                <h3 class="card-title">Giảm giá</h3>
                                <div class="card-tools">
                                    <a class="btn btn-sm btn-primary" href="giamgias/create"><i class="fas fa-plus"> </i> Tạo giảm giá</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Giảm giá</th>
                                            <th>Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($giamgias as $key => $item)
                                        <tr class="wraptr{{$item->id}}">
                                            <td></td>
                                            <td>{{$item->code}}</td>
                                            <td>{{number_format($item->giamgia)}}</td>
                                            <td>
                                                @if ($item->status == 1)
                                                    <div class="btn btn-xs btn-success btn-status" data-id="{{$item->id}}" data-toggle="tooltip" title="{{__('admin.update_status')}}">
                                                        <i class="fas fa-check"></i>
                                                    </div>
                                                @else
                                                    <div class="btn btn-xs btn-warning btn-status" data-id="{{$item->id}}" data-toggle="tooltip" title="{{__('admin.update_status')}}">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="giamgias/edit/{{$item->id}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="{{__('admin.update_info')}}">
                                                    <i class="fas fa-pen-nib"></i>
                                                </a>
                                                {{-- <div class="btn btn-xs btn-danger btn-destroy" data-id="{{$item->id}}" data-toggle="tooltip" title="{{__('admin.delete_info')}}"  >
                                                    <i class="fas fa-trash-alt"></i>
                                                </div> --}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
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
        $(document).ready( function () {
            $("#myTable").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                columnDefs: [
                    {	orderable: false},
                    { "width": "3%", "targets": 0},
                    { "width": "5%", "targets": 3, "className": "text-center"},
                    { "width": "5%", "targets": 4, "className": "text-center"},
                    // { "width": "10%", "targets": 3, "className": "text-center"},
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
        status('giamgias');
        destroy('giamgias');
    </script>
@endpush
