@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Chỉnh sửa sản phẩm')
@push('main') Sản phẩm @endpush
@push('item') {{__('admin.edit')}} @endpush
@push('linkmain'){{ 'products' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="products/{{$product->id}}/update" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h2 class="card-title">{{__('admin.edit_form')}}</h2>
                                    <div class="card-tools nutluu">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                        <a class="btn btn-sm btn-dark" href="products"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="card-body bg-info col-lg-2">
                                        <div class="form-group">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="image" class="file" accept="image/*">
                                            <input type="hidden" name="image_hidden" value="{{$product->image}}" id="image_hidden">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Chọn hình sản phẩm" id="file">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-primary">Thay đổi ảnh</button>
                                                </div>
                                            </div>
                                            <img src="{{storage_link_show('product',$product->created_at).$product->image}}?v={{time()}}" {{error_img()}} id="preview" class="img-thumbnail">
                                            <div id="remove_img" class="btn btn-xs btn-danger" data-id="{{$product->id}}" data-toggle="tooltip" title="{{__('admin.remove_img')}}">
                                                <i class="far fa-trash-alt"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Hình ảnh kho hàng</label>
                                            <input type="file" name="location_image" class="file_location" accept="image/*">
                                            <input type="hidden" name="location_image_hidden" value="{{$product->location_image}}" id="location_image_hidden">
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Chọn hình vị trí kho hàng" id="file_location">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse_location btn btn-primary">Thay đổi ảnh</button>
                                                </div>
                                            </div>
                                            <img src="{{storage_link_show('location',$product->created_at).$product->location_image}}?v={{time()}}" {{error_img()}} id="preview_location" class="img-thumbnail">
                                            <div id="remove_img_location" class="btn btn-xs btn-danger" data-id="{{$product->id}}" data-toggle="tooltip" title="{{__('admin.remove_img')}}">
                                                <i class="far fa-trash-alt"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> Nhà cung cấp </label>
                                            <select name="id_supplier" class="form-control form-control-xs select2bs4">
                                                @foreach ($suppliers as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                <option value="0">Không chọn</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-10">
                                        <div class="form-group">
                                            <label> Tên sản phẩm </label>
                                            <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Nhập tên sản phẩm" />
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label> Số lượng </label>
                                                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Nhập số lượng" />
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label> Ngày nhập </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">ngày nhập hàng</span> </div>
                                                    <input type="text" name="date_import" value="{{datevn($product->date_import)}}" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label> Giá bán </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">vnđ</span> </div>
                                                    <input type="text" name="price_sale" value="{{$product->price_sale}}" class="form-control number" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label> Giá nhập </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">vnđ</span> </div>
                                                    <input type="text" name="price_import" value="{{$product->price_import}}" class="form-control number" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> Bảo hành (số tháng) </label>
                                            <input type="number" name="warranty" value="{{ $product->warranty }}" class="form-control" placeholder="Nhập Tháng bảo hành" />
                                        </div>
                                        <div class="form-group">
                                            <label> Vị trí kho hàng </label>
                                            <input type="text" name="location" value="{{ $product->location }}" class="form-control" placeholder="Vị trí trong kho hàng" />
                                        </div>
                                        <div class="form-group">
                                            <label> Sắp xếp </label>
                                            <input type="number" name="sort" value="{{$product->sort}}" class="form-control form-control-sm" style="width: 160px" placeholder="Sắp xếp">
                                        </div>
                                        <div class="form-group">
                                            <label> {{__('admin.status')}}</label>
                                            <input type="checkbox" name="status" @if ($product->status == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="primary">
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
    .file {
        visibility: hidden;
        position: absolute;
    }
    .file_location {
        visibility: hidden;
        position: absolute;
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
    // image sản phẩm
    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('.file').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });
    // image location
    $(document).on("click", ".browse_location", function() {
        var file = $(this).parents().find(".file_location");
        file.trigger("click");
    });
    $('.file_location').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file_location").val(fileName);
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById("preview_location").src = e.target.result;
        };
        reader.readAsDataURL(this.files[0]);
    });

    // remove image
    $('#remove_img').click(function (e) {
        $('#image_hidden').val('default');
        $('#preview').remove();
    });

    $('#remove_img_location').click(function (e) {
        $('#location_image_hidden').val('default');
        $('#preview_location').remove();
    });
    //
    xoaImg('products');
    xoaImgLocation('products');
</script>
@endpush
