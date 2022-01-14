@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Sản phẩm')
@push('main') Trang chủ @endpush
@push('item') Sản phẩm @endpush
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
                                <h3 class="card-title">Sản phẩm</h3>
                                <div class="card-tools">
                                    <a class="btn btn-sm btn-primary" href="products/create"><i class="fas fa-plus"> </i> Tạo sản phẩm</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="myTable" class="table table-bordered table-striped dt-responsive nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Hình sp</th>
                                            <th>Số lượng</th>
                                            <th>Giá bán</th>
                                            <th>Giá Nhập</th>
                                            <th>Ngày nhập</th>
                                            <th>Hạn bảo hành</th>
                                            {{-- <th>Trạng thái</th> --}}
                                            <th>Tác vụ</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-body">
                                {{-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target=".flipFlop">
                                    Click Me
                                </button> --}}
                                <div class="modal fade flipFlop" id="" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="modalLabel">Danh sách bán</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="taone">
                                                A type of open-toed sandal.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
    <link rel="stylesheet" href="admin_template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="admin_template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        img {max-width:100% !important;}
    </style>
@endpush
@push('scripts')
    <!-- DataTables  & Plugins -->
    <script src="admin_template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="admin_template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="admin_template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="admin_template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function() {
            $.fn.dataTable.ext.errMode = 'throw';
            $('#myTable').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                ajax: 'product',
                columns: [
                    {
                        data: 'id', width: '15px'
                    },
                    {
                        data: 'name',
                    },
                    {
                        data: 'image', className: 'text-center', width: '50px'
                    },
                    {
                        data: 'quantity', className: 'text-center', width: '20px'
                    },
                    {
                        data: 'price_sale', className: 'text-center', width: '200px'
                    },
                    {
                        data: 'price_import', className: 'text-center', width: '200px'
                    },
                    {
                        data: 'date_import', width: '100px'
                    },
                    {
                        data: 'baohanh', className: 'text-center', width: '50px'
                    },
                    // {
                    //     data: 'status', className: 'text-center', width: '10px'
                    // },
                    {
                        data: 'action' , className: 'text-center', width: '100px'
                    }
                ],
                "columnDefs": [
                    { "targets": [2,3,4,5,6,7,8], "searchable": false }
                ],
                "ordering": false,
                "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                    var index = iDisplayIndexFull + 1;
                    $('td:eq(0)', nRow).html(index);
                    return nRow;
                },
                search: {
                    "regex": true
                },
            });
        });
    </script>
    <script>
        status('products');
        sort('products');
        destroy('products');
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function zeroPad(num, places) {
            var zero = places - num.toString().length + 1;
            return Array(+(zero > 0 && zero)).join("0") + num;
        }
        $("#myTable").on('mouseover', '.btn-viewhd', function(e) {
            var id = $(this).attr('data-id');
            var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/products/viewhd',
                    type: 'POST',
                    data: { _token: _token, id: id },
                    success: function success(data) {
                        console.log(data);
                        var a = '',b;
                        data.forEach(function(ele) {
                            if (ele.id_type == 'pro') {
                                b = '<a href="hoadonpros/edit/'+ele.id_hd+'">ID_HDSP:'+zeroPad(ele.mahoadonpro, 6)+'</a>';
                            }else{
                                b = '<a href="hoadonscs/edit/'+ele.id_hd+'">ID_HDSC:'+zeroPad(ele.mahoadonsc, 6)+'</a>';
                            }
                            c = ele.price;
                            d = ele.quantity;
                            a +=  ele.name + '___' + 'HD: ' + b + ' | Giá bán: ' + c + ' | Số lượng: ' + d + '<br>';
                        });
                        $('#taone').empty();
                        $('#taone').append("<p>"+a+"</p>");
                    }
                });
        });
    </script>
@endpush
