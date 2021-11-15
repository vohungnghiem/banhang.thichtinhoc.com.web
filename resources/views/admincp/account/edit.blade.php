@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Edit Account')
@push('main') {{__('admin.account')}} @endpush
@push('item') {{__('admin.edit')}} @endpush
@push('linkmain'){{ 'account'}}@endpush
@section('content')
<div class="content-wrapper">
    @include('admincp.layouts.light.breadcrumb')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form method="POST" action="account/{{$account->id}}/update" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="oldemail" value="{{$account->email}}">
                        <input type="hidden" name="update" value="1">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h2 class="card-title">{{__('admin.create_form')}}</h2>
                                <div class="card-tools nutluu">
                                    <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                    <a class="btn btn-sm btn-dark" href="account"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-body col-lg-2 text-center">
                                    <h4> {{__('admin.avatar')}}</h4>
                                    <div class="cropme" style="width: 150px; height: 150px;">
                                        @if ($account->avatar)
                                            <img id="img" src="{{storage_link_show('account',$account->created_at).$account->avatar}}?v={{time()}}" {{error_img()}} alt="img">
                                        @endif
                                    </div>
                                    <input type="hidden" id="input" name="avatar" value="{{$account->avatar}}"/>
                                    <div id="remove_img" class="btn btn-xs btn-danger" data-id="{{$account->id}}" data-toggle="tooltip" title="{{__('admin.remove_img')}}">
                                        <i class="far fa-trash-alt"></i>
                                    </div>
                                </div>
                                <div class="card-body col-lg-6">
                                    <div class="form-group">
                                        <label for="name"> {{__('admin.name')}} </label>
                                        <input type="text" name="name" value="{{ $account->name }}" class="form-control @if ($errors->first('name')) is-invalid @endif" id="name" placeholder="{{__('admin.name')}}">
                                        @if ($errors->first('name'))
                                            <small class="form-text text-danger">
                                                {!! $errors->first('name') !!}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="Email"> Email </label>
                                        <input class="form-control @if ($errors->first('email')) is-invalid @endif " id="Email" name="email"
                                            type="email" placeholder="Email" value="{{ $account->email }}">
                                        @if ($errors->first('email'))
                                            <small class="form-text text-danger">
                                                {!! $errors->first('email') !!}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="Phone"> {{__('admin.phone')}}</label>
                                        <input type="text" name="phone" value="{{ $account->phone }}"
                                            class="form-control " id="phone" placeholder="{{__('admin.phone')}}">
                                        @if ($errors->first('phone'))
                                            <small class="form-text text-danger">
                                                {!! $errors->first('phone') !!}
                                            </small>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label> {{__('admin.level')}}</label>
                                        <div class="form-group clearfix">
                                            @if ( Auth::user()->hasAnyRole(['super-admin']) )
                                                @foreach (levels() as $item)
                                                    @if (Auth::user()->level <= $item->id)
                                                        <div class="icheck-primary d-inline mr-2">
                                                            <input type="radio" id="r{{$item->id}}" name="level" value="{{$item->id}}" @if ($item->id == $account->level) checked @endif>
                                                            <label for="r{{$item->id}}">{{$item->name}}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @else
                                                <input type="hidden" name="level" value="{{$account->level}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body col-lg-2 bg-secondary">
                                    <div class="form-group">
                                        <label for="Password"> {{__('admin.password')}} </label>
                                        <input class="form-control @if($errors->first('password')) is-invalid @endif " name="password" id="Password" type="password" placeholder="{{__('admin.password')}}">
                                        @if($errors->first('password'))
                                            <small class="form-text text-danger" >
                                                {!! $errors->first('password') !!}
                                            </small>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="RePassword"> {{__('admin.confirm_password')}}</label>
                                        <input class="form-control @if($errors->first('passwordagain')) is-invalid @endif" name="passwordagain" id="RePassword" type="password" placeholder="{{__('admin.confirm_password')}}">
                                        @if($errors->first('passwordagain'))
                                            <small class="form-text text-danger" >
                                                {!! $errors->first('passwordagain') !!}
                                            </small>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for=""> {{__('admin.status')}}</label>
                                            <input type="checkbox" name="status" @if ($account->status == 1) checked @endif data-bootstrap-switch data-off-color="danger" data-on-color="primary">
                                        </div>
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
    <link rel="stylesheet" href="admin_template/plugins/simple-image-cropper/css/style.css?v={{ time() }}">
    <link rel="stylesheet" href="admin_template/plugins/simple-image-cropper/css/style-example.css?v={{ time() }}">
    <link rel="stylesheet" href="admin_template/plugins/simple-image-cropper/css/jquery.Jcrop.min.css">
@endpush
@push('scripts')
    <script src="admin_template/plugins/simple-image-cropper/scripts/jquery.Jcrop.js"></script>
    <script src="admin_template/plugins/simple-image-cropper/scripts/jquery.SimpleCropper.js?v={{ time() }}">
    </script>
    <script>
        $('.cropme').simpleCropper();
        $('#remove_img').click(function (e) {
            $('#input').val('default');
            $('#img').remove();
        });
        xoaImg('account');
    </script>
@endpush
