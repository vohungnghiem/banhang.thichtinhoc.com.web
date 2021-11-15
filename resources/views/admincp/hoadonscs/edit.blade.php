@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Chỉnh sửa hóa đơn sửa chửa')
@push('main') Hóa đơn sửa chửa @endpush
@push('item') {{__('admin.edit')}} @endpush
@push('linkmain'){{ 'hoadonscs' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="hoadonscs/{{$hoadonsc->id}}/update" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h2 class="card-title">Form tạo hóa đơn</h2>
                                    <div class="card-tools nutluu">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                        <a class="btn btn-sm btn-dark" href="hoadonscs"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="card-body col-lg-12">
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label> Thời gian lập </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">ngày lập</span> </div>
                                                    <input type="text" name="thoigian" value="{{datevn($hoadonsc->thoigian)}}" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label> Ngày trả </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">ngày trả hàng</span> </div>
                                                    <input type="text" name="ngaytra" value="{{datevn($hoadonsc->ngaytra)}}" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label> Tên khách hàng </label>
                                                <input type="text" name="tenkh" value="{{ $hoadonsc->tenkh }}" class="form-control" placeholder="Nhập tên khách hàng" />
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label> Số địa chỉ </label>
                                                <textarea name="diachi" rows="1" class="form-control" placeholder="Nhập địa chỉ">{{ $hoadonsc->diachi }}</textarea>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label> Số điện thoại </label>
                                                <input type="text" name="sdt" value="{{ $hoadonsc->sdt }}" class="form-control" placeholder="Nhập số điện thoại" />
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label> Email </label>
                                                <input type="text" name="email" value="{{ $hoadonsc->email }}" class="form-control" placeholder="Nhập email" />
                                            </div>
                                            <div class="form-group col-lg-8">
                                                <label> Dữ liệu cần giữ (ghi rõ đường dẫn)</label>
                                                <textarea name="dulieucangiu" rows="1" class="form-control" placeholder="Dữ liệu cần giữ">{{$hoadonsc->dulieucangiu}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label> Loại dịch vụ </label>
                                                <div class="form-group clearfix">
                                                    @foreach (loaidichvus() as $item)
                                                        <div class="icheck-primary d-inline mr-2">
                                                            <input type="radio" id="r{{$item->id}}" name="loaidichvu" value="{{$item->id}}" @if ($item->id == $hoadonsc->loaidichvu) checked @endif>
                                                            <label for="r{{$item->id}}">{{$item->name}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="btn btn-sm btn-dark btn-kiemtra"><i class="fas fa-cart-plus"></i> Kiểm tra Máy</div>
                                            </div>
                                        </div>
                                        <div id="kiemtras">
                                            @foreach ($hdkiemtras as $j => $kt)
                                                <div class="row btn-row">
                                                    <div class="form-group col-lg-5">
                                                        <label>Tên thiết bị</label>
                                                        <input type="text" name="dh_kiemtra[{{$j}}][name]" value="{{$kt->name}}" class="form-control " >
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Bệnh trạng</label>
                                                        <input type="text" name="dh_kiemtra[{{$j}}][benhtrang]" value="{{$kt->benhtrang}}" class="form-control " >
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Đề xuất</label>
                                                        <input type="text" name="dh_kiemtra[{{$j}}][dexuat]" value="{{$kt->dexuat}}" class="form-control" >
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <label>Ghi chú</label>
                                                        <input type="text" name="dh_kiemtra[{{$j}}][ghichu]" value="{{$kt->ghichu}}" class="form-control " >
                                                    </div>
                                                    <div class="form-group col-lg-1">
                                                        <div>
                                                            <label>Xóa</label><br>
                                                            <div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="btn btn-sm btn-dark btn-suachua"><i class="fas fa-cart-plus"></i> SỬA CHỬA</div>
                                            </div>
                                        </div>
                                        <div id="suachuas">
                                            @foreach ($hdsuachuas as $k => $sc)
                                                <div class="row btn-row">
                                                    <div class="form-group col-lg-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Tên thiết bị</span> </div>
                                                            <input type="text" name="dh_suachua[{{$k}}][name]" value="{{$sc->name}}" class="form-control " >
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Giá LK</span> </div>
                                                            <input type="text" name="dh_suachua[{{$k}}][price]" value="{{$sc->price}}" class="form-control number" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Phí DV</span> </div>
                                                            <input type="text" name="dh_suachua[{{$k}}][fee]" value="{{$sc->fee}}" class="form-control number" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Xóa</span> </div>
                                                            <div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="btn btn-sm btn-dark btn-sanpham"><i class="fas fa-cart-plus"></i> Thêm sản phẩm</div>
                                            </div>
                                        </div>
                                        <div id="products">
                                            @foreach ($hdsanphams as $i => $sp)
                                                <div class="row btn-row">
                                                    <div class="form-group col-lg-6">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Sản phẩm</span> </div>
                                                            <select name="hd_sanpham[{{$i}}][id]" class="form-control  sanpham ">
                                                                @foreach ($products as $item)
                                                                    <option value="{{$item->id}}" @if ($sp->id_sp == $item->id) selected @endif data-image="{{storage_link_show('product',$item->created_at).$item->image}}?v={{time()}}">
                                                                        {{$item->name}} (sp: {{$item->quantity}} ) (giá: {{number_format($item->price_sale)}}) {{baohanh($item)}}
                                                                    </option>
                                                                @endforeach
                                                                <option value="0" data-image="logo/logo.png">Không chọn</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Số lượng</span> </div>
                                                            <input type="number" name="hd_sanpham[{{$i}}][quantity]" value="{{$sp->quantity}}" class="form-control " >
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-2">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Bảo hành</span> </div>
                                                            <input type="number" name="hd_sanpham[{{$i}}][warranty]" value="{{$sp->warranty}}" class="form-control warranty" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-2 ">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend"> <span class="input-group-text">Xóa</span> </div>
                                                            <div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-12">
                                        <div class="form-group">
                                            <label> Tình trạng </label>
                                            <div class="form-group clearfix">
                                                @foreach (tinhtrangs() as $item)
                                                    <div class="icheck-primary d-inline mr-2">
                                                        <input type="radio" id="t{{$item->id}}" name="status" value="{{$item->id}}" @if ($item->id == $hoadonsc->status) checked @endif>
                                                        <label for="t{{$item->id}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                            <a href="hoadonscs/show/{{$hoadonsc->id}}" class="btn btn-sm btn-danger">
                                                <i class="fas fa-print"></i> xem hóa đơn: <span class="badge badge-dark">{{sprintf("%06d", $hoadonsc->mahoadon)}}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 20px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            margin-top: 2px;
        }
    </style>
@endpush
@push('scripts')
    <script src="admin_template/plugins/inputmask/jquery.inputmask.js"></script>
    <script>
        $('.datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
        $('.number').inputmask('999,999,999', { numericInput: true });
    </script>
    <script>
        var count = $('#products .btn-row').length;
        $(document).on('click', '.btn-sanpham', function(event) {
            var html = '';
            html += '<div class="row btn-row">'+
                '<div class="form-group col-lg-6">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Sản phẩm</span> </div>'+
                        '<select name="hd_sanpham['+count+'][id]" class="form-control  sanpham select2bs4">'+
                            '@foreach ($products as $item)'+
                            '<option value="{{$item->id}}" data-image="{{storage_link_show('product',$item->created_at).$item->image}}?v={{time()}}">{{$item->name}} (sp: {{$item->quantity}} ) (giá: {{number_format($item->price_sale)}}) {{baohanh($item)}} </option>'+
                            '@endforeach'+
                            '<option value="0">Không chọn</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Số lượng</span> </div>'+
                        '<input type="number" name="hd_sanpham['+count+'][quantity]" value="1" class="form-control " >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Bảo hành</span> </div>'+
                        '<input type="number" name="hd_sanpham['+count+'][warranty]" value="36" class="form-control warranty" >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Xóa</span> </div>'+
                        '<div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>'+
                    '</div>'+
                '</div>'+
            '</div>';
            $('#products').append(html);
            selectRefresh();
            ++count;
        });
        $(document).on('click','.btn-remove',function(event){
            event.preventDefault();
            $(this).parent().parent().parent().remove();
        });
        var count_kt = $('#kiemtras .btn-row').length;
        $(document).on('click', '.btn-kiemtra', function(event) {
            var html = '';
            html += '<div class="row btn-row">'+
                '<div class="form-group col-lg-5">'+
                    '<label>Tên thiết bị</label>'+
                    '<input type="text" name="dh_kiemtra['+count_kt+'][name]" class="form-control " >'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<label>Bệnh trạng</label>'+
                    '<input type="text" name="dh_kiemtra['+count_kt+'][benhtrang]" value="" class="form-control " >'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<label>Đề xuất</label>'+
                    '<input type="text" name="dh_kiemtra['+count_kt+'][dexuat]" class="form-control" >'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<label>Ghi chú</label>'+
                    '<input type="text" name="dh_kiemtra['+count_kt+'][ghichu]" class="form-control" >'+
                '</div>'+
                '<div class="form-group col-lg-1">'+
                    '<div>'+
                        '<label>Xóa</label> <br>'+
                        '<div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>'+
                    '</div>'+
                '</div>'+
            '</div>';
            $('#kiemtras').append(html);
            $('.number').inputmask('999,999,999', { numericInput: true });
            ++count_kt
        });

        var count_sc = $('#suachuas .btn-row').length;
        $(document).on('click', '.btn-suachua', function(event) {
            var html = '';
            html += '<div class="row btn-row">'+
                '<div class="form-group col-lg-6">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Tên thiết bị</span> </div>'+
                        '<input type="text" name="dh_suachua['+count_sc+'][name]" class="form-control " >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Giá LK</span> </div>'+
                        '<input type="text" name="dh_suachua['+count_sc+'][price]" class="form-control number" >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Phí DV</span> </div>'+
                        '<input type="text" name="dh_suachua['+count_sc+'][fee]" value="0" class="form-control number" >'+
                    '</div>'+
                '</div>'+

                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Xóa</span> </div>'+
                        '<div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>'+
                    '</div>'+
                '</div>'+
            '</div>';
            $('#suachuas').append(html);
            $('.number').inputmask('999,999,999', { numericInput: true });
            ++count_sc
        });
    </script>
    <script>
        // select2
        function selectRefresh() {
            $("#products .sanpham").select2({
                templateResult: formatState,
                templateSelection: formatState
            });
        }
        selectRefresh();
        function formatState (opt) {
            if (!opt.id) {
                return opt.text.toUpperCase();
            }
            var optimage = $(opt.element).attr('data-image');
            if(!optimage){
                return opt.text.toUpperCase();
            } else {
                var $opt = $(
                '<span><img src="' + optimage + '" width="30px" {!!error_img()!!} /> ' + opt.text.toUpperCase() + '</span>'
                );
                return $opt;
            }
        };
    </script>
      <script>
        $(document).on('change', '.sanpham', function(event) {
            var index = $(this).parent().parent().parent().index();
            var id = $(this).val();
            $.get("/hoadonpros/ajax/"+id, function(data){
                $('.warranty:eq('+index+')').val(data[0]);
                $('.totalsp:eq('+index+')').val(data[1].price_sale * data[1].quantity);
                // console.log(data[1].price_sale);
            });
         });
    </script>
@endpush
