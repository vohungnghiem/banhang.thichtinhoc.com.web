@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Tạo giảm giá')
@push('main') Giảm giá @endpush
@push('item') {{__('admin.create')}} @endpush
@push('linkmain'){{ 'giamgias' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="giamgias/store" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h2 class="card-title">{{__('admin.create_form')}}</h2>
                                    <div class="card-tools nutluu">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                        <a class="btn btn-sm btn-dark" href="giamgias"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="card-body col-lg-4">
                                        <div class="form-group">
                                            <label for="title"> CODE </label>
                                            <input type="text" name="code" value="{{ old('code',Str::random(10)) }}" class="form-control" id="title" placeholder="Nhập code" />
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label> Giảm giá </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">vnđ</span> </div>
                                                <input type="text" name="giamgia" value="{{old('giamgia')}}" class="form-control number" >
                                            </div>
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label for=""> {{__('admin.status')}}</label>
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

@endpush
@push('scripts')
<script src="admin_template/plugins/inputmask/jquery.inputmask.js"></script>
<script>
    $('.datemask').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
    $('.number').inputmask('999,999,999', { numericInput: true });
</script>
@endpush
