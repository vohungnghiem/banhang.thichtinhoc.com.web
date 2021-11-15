@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Tạo sản phẩm')
@push('main') Sản phẩm @endpush
@push('item') {{__('admin.create')}} @endpush
@push('linkmain'){{ 'phieus' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="phieus/store" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h2 class="card-title">{{__('admin.create_form')}}</h2>
                                    <div class="card-tools nutluu">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                        <a class="btn btn-sm btn-dark" href="phieus"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="card-body bg-info col-lg-2">
                                        <div class="form-group">
                                            <label>File</label>
                                            <input type="file" name="file" class="file" />
                                            <input type="hidden" name="file_hidden" value="" id="file_hidden" />
                                            <div class="input-group my-3">
                                                <input type="text" class="form-control" disabled placeholder="Chọn File" id="file">
                                                <div class="input-group-append">
                                                    <button type="button" class="browse btn btn-primary">Thay đổi file</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body col-lg-10">
                                        <div class="form-group">
                                            <label> Tên Phiếu </label>
                                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Nhập tên phiếu" />
                                        </div>
                                        <div class="form-group">
                                            <label> Loại phiếu </label>
                                            <div class=" clearfix">
                                                @foreach (types() as $item)
                                                    <div class="icheck-primary d-inline mr-2">
                                                        <input type="radio" id="r{{$item->id}}" name="type" value="{{$item->id}}" @if ($item->id == 2) checked @endif>
                                                        <label for="r{{$item->id}}">{{$item->name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-lg-6">
                                                <label> số tiền </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">vnđ</span> </div>
                                                    <input type="text" name="fee" value="{{old('fee')}}" class="form-control number" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label> Ngày nhập </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"> <span class="input-group-text">ngày nhập phiếu</span> </div>
                                                    <input type="text" name="date_import" value="{{date('d-m-Y')}}" class="form-control datemask" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy" data-mask >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> Sắp xếp </label>
                                            <input type="number" name="sort" value="1" class="form-control form-control-sm" style="width: 160px" placeholder="Sắp xếp">
                                        </div>
                                        <div class="form-group">
                                            <label> {{__('admin.status')}}</label>
                                            <input type="checkbox" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="primary">
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
</style>
@endpush
@push('scripts')
<script src="admin_template/plugins/inputmask/jquery.inputmask.js"></script>
<script>
    $('.datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
    $('.number').inputmask('999,999,999', { numericInput: true });
</script>
<script>
    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('.file').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);
        var reader = new FileReader();
    });
</script>
@endpush
