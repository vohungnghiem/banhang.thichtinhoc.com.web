@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Dashboard')
@push('main') {{ __('admin.home') }} @endpush
@push('item') {{ __('admin.dashboard') }} @endpush
@push('linkmain'){{ 'admincp' }}@endpush
    @section('content')
        <div class="content-wrapper">
            @include('admincp.layouts.light.breadcrumb')
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h4>{{ $products }}</h4>
                                    <p>Sản phẩm</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h4>{{ number_format($quantity) }}</h4>

                                    <p>Hàng tồn kho</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h4>{{ number_format($importPrice) }}</h4>
                                    <p>Tổng tiền nhập hàng</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h4>{{ number_format($tongloinhuan) }}</h4>
                                    <p>Lợi nhuận (năm {{$year}}) </p>
                                    {{-- chưa phí sửa chửa, ktra ==> --}}
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-dark">
                                <div class="inner">
                                    <h4>{{ number_format($vonchitieu) }}</h4>
                                    <p>Vốn chi tiêu</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-light">
                                <div class="inner">
                                    <h4>{{ number_format($phieuthu) }}</h4>
                                    <p>Phiếu thu</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Thống kê từng tháng {{$year}} @php $datey = date('Y'); @endphp </h4>
                                        <form action="/" method="GET">
                                            <select name="datey" id="datey" class="btn btn-sm">
                                                @for ($i = $datey; $i >= $datey - 2; $i--)
                                                    <option value="{{$i}}" {{($i == $year) ? 'selected' : ''}}>năm {{$i}}</option>
                                                @endfor
                                            </select>
                                            <button class="btn btn-sm btn-primary">ok</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body"  style="overflow:auto;">
                                    <div class="position-relative mb-4">
                                        <canvas id="myChartMonth" data-order="{{ $tkmonth }}"  loinhuan="{{$loinhuanmonth}}" width="650" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title">Thống kê theo ngày/ tháng {{$month}} năm {{$year}}</h4>
                                        <form action="/" method="GET">
                                            <select name="datem" id="datem" class="btn btn-sm">
                                                @for ($j = 1; $j <=12; $j++)
                                                    <option value="{{$j}}" {{($j == $month) ? 'selected' : ''}}>tháng {{$j}}</option>
                                                @endfor
                                            </select>
                                            {{$year}}
                                            <button class="btn btn-sm btn-primary">ok</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-body"  style="overflow:auto;">
                                    <div class="position-relative mb-4">
                                        <canvas id="myChartDay" data-order="{{ $tkday }}"  loinhuan="{{$loinhuanday}}" style="min-width: 650px" height="400"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
    @push('scripts')
    <script>
        $('#datey').change(function (e) {
            var y = $(this).val();
            window.location = "?datey="+y;
        });
        $('#datem').change(function (e) {
            var y = {{$year}};
            var m = $(this).val();
            window.location = "?datey="+y+"&datem="+m;
        });
    </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ordermonth = $('#myChartMonth').attr('data-order');
            var ordermonthloinhuan = $('#myChartMonth').attr('loinhuan');
            var dataMonth = JSON.parse(ordermonth);
            var dataMonthLoiNhuan = JSON.parse(ordermonthloinhuan);
            const ctx = document.getElementById('myChartMonth').getContext('2d');
            const myChartMonth = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
                    datasets: [{
                        label: '# TỔNG Bán SP và Sửa chửa {{$year}}',
                        data: dataMonth,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1
                    }, {
                        label: '# lợi nhuận và Sửa chửa',
                        data: dataMonthLoiNhuan,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                }
            });
        </script>
        <script>
            var orderday = $('#myChartDay').attr('data-order');
            var orderdayloinhuan = $('#myChartDay').attr('loinhuan');
            var dataDay = JSON.parse(orderday);
            var dataDayLoiNhuan = JSON.parse(orderdayloinhuan);
            var listOfDay = [];
            dataDay.forEach(function(element,key){
                var ngay = "ngày " + ++key;
                listOfDay.push(ngay);
            });
            const ctxDay = document.getElementById('myChartDay').getContext('2d');
            const myChartDay = new Chart(ctxDay, {
                type: 'bar',
                data: {
                    labels: listOfDay,
                    datasets: [{
                        label: '# TỔNG Bán SP và Sửa chửa theo ngày/ tháng {{$month}} năm {{$year}}',
                        data: dataDay,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',

                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',

                        ],
                        borderWidth: 1
                    }, {
                        label: '# lợi nhuận và Sửa chửa',
                        data: dataDayLoiNhuan,
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                }
            });
        </script>
    @endpush
