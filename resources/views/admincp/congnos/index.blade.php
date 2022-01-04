@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Công nợ')
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
                                <h3 class="card-title">Cộng nợ</h3>
                                <div class="card-tools">
                                    <a class="btn btn-sm btn-primary" href="congnos/create"><i class="fas fa-plus"> </i> Thêm công ty / tổ chức</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Tiền công nợ</th>
                                            <th>Ngày đòi nợ gần nhất</th>
                                            <th class="text-center">Công nợ</th>
                                            <th class="text-center">Xem</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($congnos as $key => $item)
                                        <tr class="wraptr{{$item->id}}">
                                            <td></td>
                                            <td>{{$item->name}}</td>
                                            <td>
                                                @php
                                                    $congnosc = 0; $congnosp = 0; $giamgia = 0;
                                                    if ($item->congno) {
                                                        foreach (explode(",", $item->congno) as $key => $itemcn) {
                                                            $congnosc += explode("-", $itemcn)[1];
                                                        }
                                                    }
                                                    if ($item->congnosp) {
                                                        foreach (explode(",", $item->congnosp) as $key => $itemsp) {
                                                            if (explode("-", $itemsp)[2] == 'sc') {
                                                                $congnosp += explode("-", $itemsp)[1];
                                                            }
                                                        }
                                                    }
                                                    if ($item->giamgia) {
                                                        foreach (explode(",", $item->giamgia) as $key => $itemgg) {
                                                            $giamgia +=$itemgg;
                                                        }
                                                    }
                                                @endphp
                                                <strong>{{number_format($congnosc + $congnosp - $giamgia)}}đ</strong> (giảm: {{number_format($giamgia)}}đ)
                                            </td>
                                            @if ($item->ngay_congno != null)
                                                <td>{{ datevn($item->ngay_congno) }}</td>
                                                <td>
                                                    <div href="congnos/congno/{{$item->id}}" class="btn btn-xs btn-info btn-congno" data-id="{{$item->id}}" data-date="{{$item->ngay_congno}}" data-toggle="tooltip" title="đòi nợ">
                                                        <i class="fas fa-dollar-sign"></i> đã đòi nợ
                                                    </div>
                                                </td>
                                            @else
                                                <td></td>
                                                <td>
                                                    <div href="congnos/congno/{{$item->id}}" class="btn btn-xs btn-danger btn-congno" data-id="{{$item->id}}" data-date="{{$item->ngay_congno}}" data-toggle="tooltip" title="đòi nợ">
                                                        <i class="fas fa-dollar-sign"></i> chưa đòi nợ
                                                    </div>
                                                </td>
                                            @endif
                                            <td>
                                                @if ($item->ngay_congno != null)
                                                    <a href="congnos/list/{{$item->id}}/{{$item->ngay_congno}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Xem các sản phẩm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @else
                                                    <a href="congnos/list/{{$item->id}}/null" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Xem các sản phẩm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="congnos/edit/{{$item->id}}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="{{__('admin.update_info')}}">
                                                    <i class="fas fa-pen-nib"></i>
                                                </a>
                                                <div class="btn btn-xs btn-danger btn-destroy" data-id="{{$item->id}}" data-toggle="tooltip" title="{{__('admin.delete_info')}}"  >
                                                    <i class="fas fa-trash-alt"></i>
                                                </div>
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
                    { "width": "20%", "targets": 2},
                    { "width": "5%", "targets": 3},
                    { "width": "5%", "targets": 4, "className": "text-center"},
                    { "width": "5%", "targets": 5, "className": "text-center"},
                    { "width": "10%", "targets": 6, "className": "text-center"},
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
        congno('congnos');
        status('congnos');
        destroy('congnos');
    </script>
@endpush
