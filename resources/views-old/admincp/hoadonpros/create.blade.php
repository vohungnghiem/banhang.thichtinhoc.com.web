@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Tạo hóa đơn sản phẩm')
@push('main') Hóa đơn sản phẩm @endpush
@push('item') {{__('admin.create')}} @endpush
@push('linkmain'){{ 'hoadonpros' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="hoadonpros/store" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h2 class="card-title">Form tạo hóa đơn</h2>
                                    <div class="card-tools nutluu">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                        <a class="btn btn-sm btn-dark" href="hoadonpros"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="card-body col-lg-12">
                                        <div class="row">
                                            <div class="form-group col-lg-2">
                                                <label> Thời gian lập </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">ngày lập</span> </div>
                                                    <input type="text" name="thoigian" value="{{date('d-m-Y')}}" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-3">
                                                <label> Tên khách hàng </label>
                                                <input type="text" name="tenkh" value="{{ old('tenkh') }}" class="form-control" placeholder="Nhập tên khách hàng" />
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label> Số điện thoại </label>
                                                <input type="text" name="sdt" value="{{ old('sdt') }}" class="form-control" placeholder="Nhập số điện thoại" />
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label> Số địa chỉ </label>
                                                <textarea name="diachi" rows="1" class="form-control" placeholder="Nhập địa chỉ">{{old('diachi')}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="btn btn-sm btn-dark btn-sanpham"><i class="fas fa-cart-plus"></i> Thêm sản phẩm</div>
                                            </div>
                                        </div>
                                        <div id="products">
                                            @for ($i = 0; $i < 1; $i++)
                                            <div class="row btn-row">
                                                <div class="form-group col-lg-6">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">Sản phẩm</span> </div>
                                                        <select name="hd_sanpham[{{$i}}][id]" class="form-control  sanpham ">
                                                            @foreach ($products as $item)
                                                                <option value="{{$item->id}}" data-image="{{storage_link_show('product',$item->created_at).$item->image}}?v={{time()}}">
                                                                    {{$item->name}} (sp: {{$item->quantity}} ) (giá: {{number_format($item->price_sale)}})
                                                                </option>
                                                            @endforeach
                                                            <option value="0" data-image="logo/logo.png">Không chọn</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">Số lượng</span> </div>
                                                        <input type="number" name="hd_sanpham[{{$i}}][quantity]" value="1" class="form-control " >
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-2">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">Bảo hành</span> </div>
                                                        <input type="number" name="hd_sanpham[{{$i}}][warranty]" value="36" class="form-control " >
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-2 ">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">Xóa</span> </div>
                                                        <div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endfor
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-12">
                                                <div class="btn btn-sm btn-dark btn-tunhap"><i class="fas fa-cart-plus"></i> Tự nhập sản phẩm</div>
                                            </div>
                                        </div>

                                        <div id="tunhaps">

                                        </div>
                                    </div>
                                    <div class="card-body col-lg-12">
                                        <div class="form-group">
                                            <label> {{__('admin.status')}}</label>
                                            <input type="checkbox" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="primary">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
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
                            '<option value="{{$item->id}}" data-image="{{storage_link_show('product',$item->created_at).$item->image}}?v={{time()}}">{{$item->name}} (sp: {{$item->quantity}} ) (giá: {{number_format($item->price_sale)}})</option>'+
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
                        '<input type="number" name="hd_sanpham['+count+'][warranty]" value="36" class="form-control " >'+
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
        var count_tn = $('#tunhaps .btn-row').length;
        $(document).on('click', '.btn-tunhap', function(event) {
            var html = '';
            html += '<div class="row btn-row">'+
                '<div class="form-group col-lg-6">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Sản phẩm</span> </div>'+
                        '<input type="text" name="dh_tunhap['+count_tn+'][name]" class="form-control " >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Số lượng</span> </div>'+
                        '<input type="number" name="dh_tunhap['+count_tn+'][quantity]" value="1" class="form-control " >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Giá</span> </div>'+
                        '<input type="text" name="dh_tunhap['+count_tn+'][price]" class="form-control number" >'+
                    '</div>'+
                '</div>'+
                '<div class="form-group col-lg-2">'+
                    '<div class="input-group">'+
                        '<div class="input-group-prepend"> <span class="input-group-text">Xóa</span> </div>'+
                        '<div class="btn btn-danger btn-remove"><i class="fas fa-trash-alt"></i></div>'+
                    '</div>'+
                '</div>'+
            '</div>';
            $('#tunhaps').append(html);
            $('.number').inputmask('999,999,999', { numericInput: true });
            ++count_tn
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
@endpush
