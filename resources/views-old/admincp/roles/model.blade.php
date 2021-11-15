@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Role')
@push('main') {{__('admin.home')}} @endpush
@push('item') {{__('admin.role')}} @endpush
@push('linkmain'){{ 'admincp' }}@endpush
    @section('content')
        <div class="content-wrapper">
            @include('admincp.layouts.light.breadcrumb')
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <form method="POST" action="admincp/modelroles" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h2 class="card-title">{{__('admin.create_form')}}</h2>
                                        <div class="card-tools nutluu">
                                            <button class="btn btn-sm btn-success" type="submit"><i class="fas fa-save"></i> {{__('admin.confirm')}} </button>
                                            <a class="btn btn-sm btn-dark" href="admincp/modelroles"><i class="fas fa-list"></i> {{__('admin.back_list')}} </a>
                                        </div>
                                    </div>
                                    <div class="row ml-0">
                                        <div class="card-body col-lg-2 bg-info">
                                            <h5 class="font-weight-bold text-danger"><i class="fas fa-user-tag"></i> {{__('admin.select_account')}}</h5>
                                            <div class="form-group">
                                                <select class="form-control select2bs4" name="user" id="user"
                                                    style="width: 100%;">
                                                    @foreach ($users as $item)
                                                        <option @if ($item->id == $user->id) selected @endif value="{{ $item->id }}">
                                                            {{ $item->name }} ({{ $item->email }})</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-body col-lg-4">
                                            <h5 class="font-weight-bold">
                                                <span class="left badge badge-danger"><i class="fas fa-user-tag"></i> {{__('admin.role')}}</span>
                                                {{__('admin.assign_role')}}
                                                <span class="right badge badge-info">{{ $user->name }}</span>
                                            </h5>
                                            <div class="row">
                                                @foreach ($roles as $role)
                                                    <div class="col-md-12">
                                                        @foreach ($role as $item)
                                                            <div class="form-group clearfix">
                                                                <div class="icheck-warning d-inline">
                                                                    <input type="checkbox" name="check[{{$item->id}}]" id="check{{ $item->id }}"
                                                                        @if ($item->role == 1) checked @endif>
                                                                        <label for="check{{ $item->id }}">
                                                                            {{ $item->name }}
                                                                        </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="card-body col-lg-6">
                                            <h5 class="font-weight-bold">
                                                <span class="left badge badge-danger"><i class="fas fa-user-tag"></i> {{__('admin.permission')}}</span>
                                                {{__('admin.author_account')}}
                                                <span class="right badge badge-info">{{ $user->name }}</span>
                                            </h5>
                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-md-12">
                                                        @foreach ($permission as $item)
                                                            <div class="form-group clearfix">
                                                                <div class="icheck-warning d-inline">
                                                                    <input type="checkbox" name="checka[{{$item->id}}]" id="checka{{ $item->id }}"
                                                                        @if ($item->role == 1) checked @endif>
                                                                    <label for="checka{{ $item->id }}">
                                                                        {{ $item->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
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
        <script>
            $(document).ready(function() {
                $('#user').change(function(e) {
                    var user = $(this).val();
                    window.location.assign('admincp/modelroles?user=' + user);
                });
            });
        </script>
    @endpush
