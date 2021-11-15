<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="content-wrapper">
    @if (session('error'))
        <script>
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 20000
            });
            Swal.fire({
                icon: 'error',
                title: 'chúng tôi không chấp nhận link vừa nhập'
            })
        </script>
    @endif
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="row">
                            <div class="card-body col-lg-12">
                                <div  id="tableprint">
                                    <style type="text/css">
                                        #tableprint .table1 tr td {
                                            font-family: "Times New Roman", Times, serif;
                                        }
                                        #tableprint .table1 .trhdsanpham td {
                                            padding: 100px;
                                        }
                                    </style>

                                    <table class="table1" cellspacing="0" cellpadding="0" style="position: relative; margin: auto; font-family: 'Times New Roman', Times, serif; font-size: 20px;">
                                        <img width="400" src="{{asset('logo/tth.png')}}" alt="logo" style="position:absolute;margin:auto;left: 0;right: 0;text-align: center;top:15%;opacity:0.2;height:auto">
                                        <tr style="font-size: 16px;">
                                            <td style="text-align: center"><img  width="80" src="{{asset('logo/tth.png')}}" alt="logo"></td>
                                            <td colspan="3">CỬA HÀNG THƯƠNG MẠI DỊCH VỤ THÍCH TIN HỌC <br>Địa chỉ: Số 1B Đường số 10, Phường Tân Quy, Quận 7 <br>Điện thoại: 0901.505.202</td>
                                            <td colspan="2">Số: {{$hoadonsc->mahoadon}}<br>Thời gian: {{datevn($hoadonsc->thoigian)}}<br>Ngày trả: {{datevn($hoadonsc->ngaytra)}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="text-align: center"><h4><strong>PHIẾU KIỂM TRA,SỬA CHỮA BẢO HÀNH VÀ DỊCH VỤ <br>(KIÊM BIÊN NHẬN)</strong></h4></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Tên Khách Hàng: {{$hoadonsc->tenkh}}</td>
                                            <td colspan="2">Địa chỉ: {{$hoadonsc->diachi}}</td>
                                            <td>DT: {{$hoadonsc->sdt}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Dữ liệu cần giữ (ghi rõ đường dẫn): {{$hoadonsc->dulieucangiu}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Loại dịch vụ: @foreach (loaidichvus() as $item) @if($item->id == $hoadonsc->loaidichvu) {{$item->name}} @endif @endforeach</td>
                                        </tr>
                                        @php $so = 0; @endphp
                                        @if ($hdkiemtras->count() > 0)
                                            <tr>
                                                <td colspan="6"><strong>{{++$so}}.Kiểm tra máy</strong> (Phí kiểm tra 30.000đ):</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">STT</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Tên thiết bị và cấu hình</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Bệnh trạng</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Đề xuất</td>
                                                <td style="border: 1px solid #000;text-align:center;" colspan="2">Ghi chú</td>
                                            </tr>
                                            @foreach ($hdkiemtras as $item)
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->stt+1}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->name}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->benhtrang}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->dexuat}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0" colspan="2">{{$item->ghichu}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        @if ($hdsuachuas->count() > 0)
                                            <tr>
                                                <td colspan="6"><strong>{{++$so}}.Sửa chữa</strong> (Thay thế, sửa chữa và cài đặt phần mềm):</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">STT</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Tên thiết bị và danh mục sửa chữa</td>
                                                <td colspan="2" style="border: 1px solid #000;text-align:center ;border-right:0;">Giá linh kiện thay thế</td>
                                                <td style="border: 1px solid #000;text-align:center;" colspan="2">Phí dich vụ</td>
                                            </tr>
                                            @foreach ($hdsuachuas as $item)
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->stt+1}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->name}}</td>
                                                <td colspan="2" style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{number_format($item->price)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0" colspan="2">{{number_format($item->fee)}}</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        @if ($hdsanphams->count() > 0)
                                            <tr>
                                                <td colspan="6"><strong>{{++$so}}.Mua sản phẩm</strong> :</td>
                                            </tr>
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">STT</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Dịch vụ</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Số lượng</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;">Đơn giá</td>
                                                <td style="border: 1px solid #000;text-align:center;">Thành tiền</td>
                                                <td style="border: 1px solid #000;text-align:center;">Bảo hành</td>
                                            </tr>
                                            @foreach ($hdsanphams as $item)
                                            <tr>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->stt+1}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->name}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{$item->quantity}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-right:0;border-top:0">{{number_format($item->price)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0">{{number_format($item->total)}}</td>
                                                <td style="border: 1px solid #000;text-align:center ;border-top:0">{{$item->warranty}}TH</td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        <tr>
                                            <td colspan="6"><strong>Chi phí sửa chữa (Tổng @for ($i = 1; $i <= $so; $i++) {{$i}} , @endfor):
                                                {{number_format($hdsuachuas->sum('price') + $hdsuachuas->sum('fee') + $hdsanphams->sum('total'))}}đ</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Khách hàng</td>
                                            <td colspan="2">Kỹ thuật</td>
                                            <td >Cửa hàng</td>
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
                                        <tr><td colspan="6">*Giấy có giá trị trong 30 ngày,nếu mất giấy hoặc giấy quá thời hạn thì cửa hàng không chịu trách nhiệm</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
