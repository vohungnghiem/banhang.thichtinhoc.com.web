@extends('admincp.layouts.light.master')
@section('title', 'Admincp | Chỉnh sửa hóa đơn sản phẩm')
@push('main') Hóa đơn sản phẩm @endpush
@push('item') Show hóa đơn @endpush
@push('linkmain'){{ 'hoadonpros' }}@endpush
@section('content')
    <div class="content-wrapper">
        @include('admincp.layouts.light.breadcrumb')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h2 class="card-title">IN HÓA ĐƠN</h2>
                                <div class="card-tools nutluu">
                                    <a href="hoadonpros" class="btn btn-secondary"> <i class="fas fa-list"></i><span class="caption"> Trở lại</span></a>
                                    <a href="hoadonpros/edit/{{$hoadonpro->id}}" class="btn btn-info"> <i class="fas fa-pencil-alt"></i><span class="caption"> Chỉnh sửa</span></a>
                                    <button class="btn btn-danger" onclick="printData('tableprint')"> <i class="fas fa-print"></i> In hóa đơn</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="card-body col-lg-12">
                                    <div  id="tableprint">
                                        <style type="text/css">
                                            /* body {
                                                font-family: "Times New Roman", Times, serif;
                                                font-size: 20px;
                                            } */
                                            /* #tableprint .table1 {
                                                font-family: "Times New Roman", Times, serif; font-size: 20px;
                                            }
                                            */
                                            #tableprint .table1 tr td {
                                                font-family: "Times New Roman", Times, serif;
                                            }
                                            #tableprint .table1 .trhdsanpham td {
                                                padding: 10px;
                                            }
                                        </style>
                                        <table class="table1" cellspacing="0" cellpadding="0" style="position: relative; margin: auto; font-family: 'Times New Roman', Times, serif; font-size: 20px;">
                                            <img width="400" src="{{asset('logo/tth.png')}}" alt="logo" style="position:absolute;margin:auto;left: 0;right: 0;text-align: center;top:15%;opacity:0.2;height:auto">
                                            <tr>
                                                <td style="text-align: center"><img  width="80" src="{{asset('logo/tth.png')}}" alt="logo"></td>
                                                <td colspan="6"><b class="fg-red">CỬA HÀNG THƯƠNG MẠI DỊCH VỤ THÍCH TIN HỌC</b><br>Địa chỉ:  Số 1B, Đường Số 10. Phường Tân Quy. Quận 7<br>Điện thoại: 0901 505 502<br>Web: https://thichtinhoc.com     *     Email: cskh@thichtinhoc.com									</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: center"><h4><b>HÓA ĐƠN BÁN HÀNG</b></h4></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: center">(Số:{{sprintf("%06d", $hoadonpro->mahoadon)}}/PBH-AP)</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right">Ngày  {{datevnfull($hoadonpro->thoigian)}} </td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Tên khách hàng: {{$hoadonpro->tenkh}}</td>
                                                <td colspan="3" style="text-align: right">Điện thoại: {{$hoadonpro->sdt}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">Địa chỉ: {{$hoadonpro->diachi}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6"><br></td>
                                            </tr>
                                            <tr class="trhdsanpham" style="padding: 10px;">
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">STT</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Dịch vụ</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Số lượng</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Đơn giá</td>
                                                <td style="border: 1px solid #000;text-align:center;">Thành tiền</td>
                                                <td style="border: 1px solid #000;text-align:center;">Bảo hành</td>
                                            </tr>
                                             @foreach ($hdsanphams as $i =>$item)
                                            <tr class="trhdsanpham">
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{++$i}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->name}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->quantity}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{number_format($item->price)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0">{{number_format($item->total)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0">{{$item->warranty}}TH</td>
                                            </tr>
                                            @endforeach
                                            {{--
                                            @foreach ($service as $item)
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->stt}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->service}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->quantity}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{number_format($item->unitPrice)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0">{{number_format($item->totalPrice)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0">{{$item->warrantyPeriod}}</td>
                                            </tr>
                                            @endforeach
                                            --}}
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0"></td>
                                                <td colspan="3" style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">TỔNG CỘNG</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0"> {{number_format($hdsanphams->sum('total'))}} </td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0"></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr><td class="py-0" colspan="6">Hoá đơn - kiêm bảo hành được lập thành 02 bản, mỗi bên giữ một bản, phiếu có giá trị trong thời hạn bảo hành.</td></tr>
                                            <tr><td class="py-0" colspan="6">Điều kiện bảo hành:</td></tr>
                                            <tr><td class="py-0" colspan="6">- Tem bảo hành (dán trong sản phẩm) và phiếu bảo hành không bị nhàu nát, chỉnh sửa,…</td></tr>
                                            <tr><td class="py-0" colspan="6">- Thời hạn bảo hành trên phiếu vẫn còn.</td></tr>
                                            <tr><td class="py-0" colspan="6">- Chỉ bảo hành dịch vụ đã được thực hiện (Quý khách vui lòng kiểm tra mọi tính năng của máy trước khi rời khỏi cửa hàng).</tr>
                                            <tr><td class="py-0" colspan="6">Từ chối bảo hành:</tr>
                                            <tr><td class="py-0" colspan="6">- Thời hạn bảo hành trên phiếu đã hết.</tr>
                                            <tr><td class="py-0" colspan="6">- Máy bị rơi vỡ, vào nước, cháy nổ do chập điện,…</tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">KHÁCH HÀNG</td>
                                                <td colspan="3" style="text-align: right">NGƯỜI BÁN HÀNG</td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td><br></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: right">BÙI QUANG SƠN</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-body col-lg-12">
                                    <div class="text-center ">
                                        <a href="hoadonpros" class="btn btn-secondary"> <i class="fas fa-list"></i><span class="caption"> Trở lại</span></a>
                                        <button class="btn btn-danger" onclick="printData('tableprint')"> <i class="fas fa-print"></i> In hóa đơn</button>
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

@endpush
@push('scripts')
<script>
     function printData(strid){
        var prtContent = document.getElementById(strid);
        var WinPrint = window.open('','','letf=0,top=0,width=800,height=auto');
        WinPrint.document.write(prtContent.innerHTML);
        WinPrint.document.close();
        WinPrint.focus();
        WinPrint.print();
    }
    var options = {
        showTop: true,
        timeout: 5000,
    }
</script>
@endpush
