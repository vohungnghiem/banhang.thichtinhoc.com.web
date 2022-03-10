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
                            <div class="card-header ">
                                <h3 class="card-title font-weight-bold {{$date ? 'text-info' : 'text-danger'}}">{{$congno->name}} {{$date ? '(đã thanh toán)' : '(yêu cầu thanh toán)'}} </h3>

                                <div class="card-tools">
                                    <b class="text-warning">{{$loai == 'suachua' ? 'Đơn hàng sửa chửa' : 'Đơn hàng bán sản phẩm' }}</b>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped1 dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Tên sản phẩm</th>
                                            <th style="width: 200px">Tiền công nợ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listscs as $key => $item)
                                        <tr class="bg-secondary">
                                            <td colspan="3">{{datevn($item->thoigian)}} (MHĐ:{{sprintf("%06d", $item->mahoadon)}}) - Tên khách: {{$item->tenkh}}</td>
                                        </tr>
                                            @if ($item->congno)
                                                @foreach (explode(",", $item->congno) as $key => $itemsc)
                                                    <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{explode("@@", $itemsc)[0]}}</td>
                                                        <td class="font-weight-bold">{{number_format(explode("@@", $itemsc)[1])}}đ</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            @if ($item->congnosp)
                                                @if ($item->loai == 'suachua')
                                                    @foreach (explode(",", $item->congnosp) as $key => $itemsp)
                                                        @if (explode("-", $itemsp)[2] == 'sc')
                                                            <tr>
                                                                <td>{{++$key}}</td>
                                                                <td>(++) {{explode("-", $itemsp)[3]}}</td>
                                                                <td >
                                                                    <div class="font-weight-bold">{{number_format(explode("-", $itemsp)[1] - $item->giamgia) }}đ</div>
                                                                    @if ($item->giamgia == 0)
                                                                        (Giảm giá: {{number_format($item->giamgia)}}đ)
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach (explode(",", $item->congnosp) as $key => $itemsp)
                                                        @if (explode("-", $itemsp)[2] == 'pro')
                                                            <tr>
                                                                <td>{{++$key}}</td>
                                                                <td>(++) {{explode("-", $itemsp)[3]}}</td>
                                                                <td >
                                                                    <div class="font-weight-bold">{{number_format(explode("-", $itemsp)[1] - $item->giamgia) }}đ</div>
                                                                    @if ($item->giamgia == 0)
                                                                        (Giảm giá: {{number_format($item->giamgia)}}đ)
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td class="font-weight-bold text-right text-danger pr-5" colspan="2">Tổng tiền:</td>
                                            <td class="text-danger">
                                                @php $tongcongno = 0; $tonggiamgia = 0; @endphp

                                                @foreach($listscs as $key => $item)
                                                    @php
                                                        $congnosc = 0; $congnosp = 0; $giamgia = 0;
                                                        if ($item->congno) {
                                                            foreach (explode(",", $item->congno) as $key => $itemcn) {
                                                                $congnosc += explode("@@", $itemcn)[1];
                                                            }
                                                        }
                                                        if ($item->congnosp ) {
                                                            if ($item->loai == "suachua") {
                                                                foreach (explode(",", $item->congnosp) as $key => $itemsp) {
                                                                    if (explode("-", $itemsp)[2] == 'sc') {
                                                                        $congnosp += explode("-", $itemsp)[1];
                                                                    }
                                                                }
                                                            }else{
                                                                foreach (explode(",", $item->congnosp) as $key => $itemsp) {
                                                                    if (explode("-", $itemsp)[2] == 'pro') {
                                                                        $congnosp += explode("-", $itemsp)[1];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        if ($item->giamgia) {
                                                            foreach (explode(",", $item->giamgia) as $key => $itemgg) {
                                                                $giamgia +=$itemgg;
                                                            }
                                                        }
                                                        $tongcongno += ($congnosc + $congnosp - $giamgia);
                                                        $tonggiamgia += $giamgia;
                                                    @endphp

                                                @endforeach
                                                <strong>{{number_format($tongcongno)}}đ</strong> <br> (giảm: {{number_format($tonggiamgia)}}đ)
                                            </td>
                                        </tr>
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
    {{-- <link rel="stylesheet" href="admin_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
@endpush
@push('scripts')

@endpush
