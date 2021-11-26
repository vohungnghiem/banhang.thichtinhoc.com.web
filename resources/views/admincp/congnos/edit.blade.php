@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Chỉnh sửa nhà cung cấp')
@push('main') Nhà cung cấp @endpush
@push('item') {{__('admin.edit')}} @endpush
@push('linkmain'){{ 'suppliers' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="suppliers/{{$supplier->id}}/update" autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h2 class="card-title">{{__('admin.edit_form')}}</h2>
                                    <div class="card-tools nutluu">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                        <a class="btn btn-sm btn-dark" href="suppliers"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                    </div>
                                </div>
                                <div class="row ml-0">
                                    <div class="card-body col-lg-4">
                                        <div class="form-group">
                                            <label for="title"> Tên </label>
                                            <input type="text" name="name" value="{{$supplier->name}}" class="form-control" id="title" placeholder="Nhập tên" />
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label for=""> {{__('admin.status')}}</label>
                                            <input type="checkbox" name="status" @if ($supplier->status == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="primary">
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

@endpush
