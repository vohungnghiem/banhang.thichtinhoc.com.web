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
                                <h3 class="card-title font-weight-bold {{$date ? 'text-info' : 'text-danger'}}">{{$congno->name}} {{$date ? '(đã thanh toán)' : '(yêu cầu thanh toán)'}}</h3>
                                <div class="card-tools">
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
                                            @foreach (explode(",", $item->namesc) as $key => $itemsc)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{explode("-", $itemsc)[0]}}</td>
                                                    <td class="font-weight-bold">{{number_format(explode("-", $itemsc)[1])}}</td>
                                                </tr>
                                            @endforeach
                                            @if ($item->namesp)
                                            @foreach (explode(",", $item->namesp) as $itemsp)
                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>(++) {{explode("-", $itemsp)[0]}}</td>
                                                    <td class="font-weight-bold">{{number_format(explode("-", $itemsp)[1])}}</td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        @endforeach
                                        <tr>
                                            <td class="font-weight-bold text-right text-danger pr-5" colspan="2">Tổng tiền:</td>
                                            <td class="font-weight-bold text-danger">{{number_format(array_sum(array_column($listscs->toArray(), 'congno')))}}</td>
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
