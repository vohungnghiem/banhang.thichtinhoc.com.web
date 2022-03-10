<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    public function index() {
        $year = isset($_GET['datey']) ? $_GET['datey'] : date('Y');
        $month = isset($_GET['datem']) ? $_GET['datem'] : date('m');
        $setpercent = DB::table('vhn_setups')->where('name','percent')->first();
        $setpercentsc = DB::table('vhn_setups')->where('name','percentsc')->first();

        $products = DB::table('vhn_products')->count();
        $quantity = DB::table('vhn_products')->sum('quantity');

        $importPrice = DB::table('vhn_products')->sum(DB::raw('quantity * price_import'));

        $tongloinhuan = $this->tongLoiNhuan($year);
        $tongloinhuanbanhang = $this->tongLoiNhuanBanHang($year);
        $phieuthu = DB::table('vhn_phieus')->where('type','=',1)->sum('fee');
        $phieuchi = DB::table('vhn_phieus')->where('type','=',2)->sum('fee');
        $phieurut = DB::table('vhn_phieus')->where('type','=',3)->whereYear('date_import',$year)->sum('fee');
        $phieurutsc = DB::table('vhn_phieus')->where([['type','=',3],['idrut',1]])->whereYear('date_import',$year)->sum('fee');
        $phieurutbh = DB::table('vhn_phieus')->where([['type','=',3],['idrut',2]])->whereYear('date_import',$year)->sum('fee');
        $hoivon = DB::table('vhn_hoadon_scs')
            ->where('vhn_hoadon_scs.status','>=',4)
            ->where(function($q) {
                $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                  ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
            })
            ->sum('hoivon');
        $loinhuan_bansp = DB::table('vhn_hoadon_pros')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->where('vhn_hd_sanphams.id_type','pro')
            ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
        $loinhuan_bansp = $loinhuan_bansp * (100 - $setpercent->value) / 100;
        $loinhuan_bansc = DB::table('vhn_hoadon_scs')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->leftJoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
            // ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','sc')
            ->where('vhn_hoadon_scs.status','>=',4)
            ->where(function($q) {
                $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
            })
            ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
        $loinhuan_bansc = $loinhuan_bansc * (100 - $setpercent->value) / 100;
        $vonchitieu = $phieuthu - $importPrice - $phieuchi + $hoivon + $loinhuan_bansp + $loinhuan_bansc;

        # test
        // $vonchitieu = $loinhuan_bansp;
        $tkmonth = $this->chartMonth($year);
        $loinhuanmonth = $this->chartLoinhuanMonth($year);
        $tkday = $this->chartDay($year,$month);
        $loinhuanday = $this->chartLoinhuanDay($year,$month);
        return view('admincp.home.dashboard',compact('products','quantity','importPrice','tongloinhuan','tongloinhuanbanhang','vonchitieu','phieuthu','phieuchi','phieurut','phieurutsc','phieurutbh','tkmonth','loinhuanmonth','tkday','loinhuanday','year','month','setpercent','setpercentsc'));
    }
    public function tongLoiNhuan($year) {

        $loinhuan_tunhap = DB::table('vhn_hoadon_scs')->whereYear('thoigian',$year)
            ->where('vhn_hoadon_scs.status','>=',4)
            ->where(function($q) {
                $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
            })
            ->sum('loinhuan'); // lợi nhuận phần trăm
            # đang sửa

        $tongloinhuan = $loinhuan_tunhap;
        return $tongloinhuan;
    }
    public function tongLoiNhuanBanHang($year) {
        $setpercent = DB::table('vhn_setups')->where('name','percent')->first();
        $loinhuan_bansp = DB::table('vhn_hoadon_pros')
            ->join('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->join('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','pro')
            ->sum(DB::raw('vhn_hd_sanphams.total  - (vhn_hd_sanphams.quantity * vhn_products.price_import )'));
        $giamgia_bansp = DB::table('vhn_hoadon_pros')
            ->join('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->join('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
            ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','pro')
            ->sum(DB::raw('vhn_giamgias.giamgia'));
        $loinhuan_bansp = $loinhuan_bansp *  $setpercent->value / 100 - $giamgia_bansp;
        $loinhuan_bansc = DB::table('vhn_hoadon_scs')
            ->join('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->join('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','sc')
            ->where('vhn_hoadon_scs.status','>=',4)
            ->where(function($q) {
                $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
            })
            ->sum(DB::raw('vhn_hd_sanphams.total  - (vhn_hd_sanphams.quantity * vhn_products.price_import )'));
        // $giamgia_bansc = 0;
        $giamgia_bansc = DB::table('vhn_hoadon_scs')
            ->join('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->join('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
            ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','sc')
            ->where('vhn_hoadon_scs.status','>=',4)
            ->where(function($q) {
                $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
            })
            ->sum(DB::raw('vhn_giamgias.giamgia'));
        $loinhuan_bansc = $loinhuan_bansc *  $setpercent->value / 100 - $giamgia_bansc;
        $loinhuan_sanpham_tunhap = 0; //DB::table('vhn_hd_tunhaps')->sum(DB::raw('price')); // lợi nhuận sản phẩm tự nhập (vd: con vít) * ít nhập dữ liệu
        $tongloinhuan = $loinhuan_bansp + $loinhuan_bansc + $loinhuan_sanpham_tunhap;
        return $tongloinhuan;
    }
    public function chartMonth($year) {
        $hoadonMonth = array();
        for ($i=1; $i <= 12 ; $i++) {
            $ban_pro = DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_hd_sanphams.total'));
            $ban_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_hd_sanphams.total'));
            $phisuachua = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->sum(DB::raw('vhn_hd_suachuas.price + vhn_hd_suachuas.fee'));
            array_push($hoadonMonth,$ban_pro + $ban_sc + $phisuachua);
        }
        $tkmonth = '['.implode(",",$hoadonMonth).']';
        return $tkmonth;
    }
    public function chartLoinhuanMonth($year) {
        $setpercent = DB::table('vhn_setups')->where('name','percent')->first();
        $hoadonMonth = array();
        for ($i=1; $i <= 12 ; $i++) {
            $ban_pro = DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_hd_sanphams.total  - (vhn_hd_sanphams.quantity * vhn_products.price_import )'));
            $giamgia_pro = DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->leftJoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_giamgias.giamgia'));
            $ban_pro = $ban_pro *  $setpercent->value / 100 - $giamgia_pro;

            $ban_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
            $giamgia_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_giamgias.giamgia'));
            $ban_sc = $ban_sc *  $setpercent->value / 100 - $giamgia_sc;
            $phisuachua =
            DB::table('vhn_hoadon_scs')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->sum(DB::raw('loinhuan'));
            array_push($hoadonMonth,$ban_pro + $ban_sc + $phisuachua);
        }
        $tkmonth = '['.implode(",",$hoadonMonth).']';
        return $tkmonth;
    }
    public function chartDay($year,$month) {
        $getdate = $year.'-'.$month;
        $hoadonDay = array();
        for ($i=1; $i <= date("t", strtotime($getdate)) ; $i++) {
            $ban_pro = DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_hd_sanphams.total'));
            $ban_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hd_sanphams.id_type','sc')
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->sum(DB::raw('vhn_hd_sanphams.total'));
            $phisuachua = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->sum(DB::raw('vhn_hd_suachuas.price + vhn_hd_suachuas.fee'));
            array_push($hoadonDay,$ban_pro + $ban_sc + $phisuachua);
        }
        $tkday = '['.implode(",",$hoadonDay).']';
        return $tkday;
    }
    public function chartLoinhuanDay($year,$month) {
        $setpercent = DB::table('vhn_setups')->where('name','percent')->first();
        $getdate = $year.'-'.$month;
        $hoadonDay = array();
        for ($i=1; $i <= date("t") ; $i++) {
            $ban_pro = DB::table('vhn_hoadon_pros')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
            ->where('vhn_hd_sanphams.id_type','pro')
            ->sum(DB::raw('vhn_hd_sanphams.total  - (vhn_hd_sanphams.quantity * vhn_products.price_import )'));
            $giamgia_pro = DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->leftJoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_giamgias.giamgia'));
            $ban_pro = $ban_pro *  $setpercent->value / 100 - $giamgia_pro;

            $ban_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
            $giamgia_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_giamgias.giamgia'));
            $ban_sc = $ban_sc *  $setpercent->value / 100 - $giamgia_sc;


            $phisuachua = DB::table('vhn_hoadon_scs')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hoadon_scs.status','>=',4)
                ->where(function($q) {
                    $q->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.ngay_congno','<>',NULL]])
                    ->orWhere('vhn_hoadon_scs.id_congno','<=', 0);
                })
                ->sum(DB::raw('loinhuan'));
                array_push($hoadonDay,$ban_pro + $ban_sc + $phisuachua);
        }
        $tkday = '['.implode(",",$hoadonDay).']';
        return $tkday;
    }
    public function setup(Request $request,$name) {
        DB::table('vhn_setups')->updateOrInsert(
            ['name' => $name],
            [
                'value' => $request->value,
                'text' => $request->text
            ]
        );
        return redirect()->back()->with('success');
    }

}
