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
                                <h3 class="card-title">Danh sách sản phẩm ({{$hoadonsc->tenkh}})</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Tên sản phẩm sửa chửa</th>
                                            <th style="width: 200px">Tiền công nợ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listsc as $key => $item)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$item->name}}</td>
                                            <td>{{number_format($item->price)}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%">#</th>
                                            <th>Tên sản phẩm bán hàng</th>
                                            <th>số lượng</th>
                                            <th>gía tiền</th>
                                            <th style="width: 200px">Tiền công nợ</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listsp as $key => $item)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$item->name}}</td>
                                            <th>{{$item->quantity}}</th>
                                            <th>{{number_format($item->price)}}</th>
                                            <td>{{number_format($item->total)}}</td>
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
    {{-- <link rel="stylesheet" href="admin_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> --}}
@endpush
@push('scripts')

@endpush
