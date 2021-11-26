@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Danh sách')
@push('main') Trang chủ @endpush
@push('item') Công nợ @endpush
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
                                <h3 class="card-title">Công nợ</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên Khách hàng</th>
                                            <th>Tiền công nợ</th>
                                            <th>Ngày đòi nợ gần nhất</th>
                                            <th class="text-center">Công nợ</th>
                                            <th class="text-center">Xem</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listsc as $key => $item)
                                        <tr>
                                            <td></td>
                                            {{-- <td>{{$item->tenkh}}</td>
                                            <td>{{number_format($item->congno)}}</td>
                                            @if ($item->ngay_congno != null)
                                                <td>{{ datevn($item->ngay_congno) }}</td>
                                                <td>
                                                    <div href="congnos/congno/{{$item->id}}" class="btn btn-xs btn-info btn-congno" data-id="{{$item->id}}" data-toggle="tooltip" title="đòi nợ">
                                                        <i class="fas fa-dollar-sign"></i> đã đòi nợ
                                                    </div>
                                                </td>
                                            @else
                                                <td></td>
                                                <td>
                                                    <div href="congnos/congno/{{$item->id}}" class="btn btn-xs btn-danger btn-congno" data-id="{{$item->id}}" data-toggle="tooltip" title="đòi nợ">
                                                        <i class="fas fa-dollar-sign"></i> chưa đòi nợ
                                                    </div>
                                                </td>
                                            @endif
                                            <td>
                                                <a href="congnos/list/{{$item->id}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Xem các sản phẩm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td> --}}
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
                    { "width": "20%", "targets": 2, "className": "text-center"},
                    { "width": "10%", "targets": 3, "className": "text-center"},
                    { "width": "5%", "targets": 4, "className": "text-center"},
                    { "width": "5%", "targets": 5, "className": "text-center"},
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

@endpush
