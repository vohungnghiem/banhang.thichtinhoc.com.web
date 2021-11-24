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

        $products = DB::table('vhn_products')->count();
        $quantity = DB::table('vhn_products')->sum('quantity');

        $importPrice = DB::table('vhn_products')->sum(DB::raw('quantity * price_import'));

        $tongloinhuan = $this->tongLoiNhuan($year);

        $phieuthu = DB::table('vhn_phieus')->where('type','=',1)->sum('fee');
        $phieuchi = DB::table('vhn_phieus')->where('type','=',2)->sum('fee');
        $vonchitieu = $phieuthu - $importPrice - $phieuchi;

        $tkmonth = $this->chartMonth($year);
        $loinhuanmonth = $this->chartLoinhuanMonth($year);
        $tkday = $this->chartDay($year,$month);
        $loinhuanday = $this->chartLoinhuanDay($year,$month);
        return view('admincp.home.dashboard',compact('products','quantity','importPrice','tongloinhuan','vonchitieu','phieuthu','tkmonth','loinhuanmonth','tkday','loinhuanday','year','month','setpercent'));
    }
    public function tongLoiNhuan($year) {
        $loinhuan_tunhap = DB::table('vhn_hoadon_scs')->whereYear('thoigian',$year)->where([['vhn_hoadon_scs.status','>=',4]])->sum('loinhuan'); // lợi nhuận sửa chửa tự nhập
        $loinhuan_bansp = DB::table('vhn_hoadon_pros')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','pro')
            ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
        $loinhuan_bansc = DB::table('vhn_hoadon_scs')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
            ->whereYear('thoigian',$year)
            ->where('vhn_hd_sanphams.id_type','sc')
            ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
        $loinhuan_sanpham_tunhap = DB::table('vhn_hd_tunhaps')->sum(DB::raw('price')); // lợi nhuận sản phẩm tự nhập (vd: con vít) * ít nhập dữ liệu

        $tongloinhuan = $loinhuan_tunhap + $loinhuan_bansp + $loinhuan_bansc + $loinhuan_sanpham_tunhap;
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
                ->where([['vhn_hoadon_scs.status','>=',4]])
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_hd_sanphams.total'));
            $phisuachua = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where([['vhn_hoadon_scs.status','>=',4]])
                ->sum(DB::raw('vhn_hd_suachuas.price + vhn_hd_suachuas.fee'));
            array_push($hoadonMonth,$ban_pro + $ban_sc + $phisuachua);
        }
        $tkmonth = '['.implode(",",$hoadonMonth).']';
        return $tkmonth;
    }
    public function chartLoinhuanMonth($year) {
        $hoadonMonth = array();
        for ($i=1; $i <= 12 ; $i++) {
            $ban_pro =
            DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
            $ban_sc =
            DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where([['vhn_hoadon_scs.status','>=',4]])
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
            $phisuachua =
            DB::table('vhn_hoadon_scs')
                ->whereYear('thoigian',$year)
                ->whereMonth('thoigian',$i)
                ->where([['vhn_hoadon_scs.status','>=',4]])
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
                ->sum(DB::raw('vhn_hd_sanphams.total'));
            $phisuachua = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->sum(DB::raw('vhn_hd_suachuas.price + vhn_hd_suachuas.fee'));
            array_push($hoadonDay,$ban_pro + $ban_sc + $phisuachua);
        }
        $tkday = '['.implode(",",$hoadonDay).']';
        return $tkday;
    }
    public function chartLoinhuanDay($year,$month) {
        $getdate = $year.'-'.$month;
        $hoadonDay = array();
        for ($i=1; $i <= date("t") ; $i++) {
            $ban_pro = DB::table('vhn_hoadon_pros')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hd_sanphams.id_type','pro')
                ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
            $ban_sc = DB::table('vhn_hoadon_scs')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_products','vhn_products.id','=','vhn_hd_sanphams.id_sp')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
                ->where('vhn_hd_sanphams.id_type','sc')
                ->sum(DB::raw('vhn_hd_sanphams.total - (vhn_hd_sanphams.quantity * vhn_products.price_import)'));
            $phisuachua = DB::table('vhn_hoadon_scs')
                ->whereDate('thoigian','=',date('Y-m-d', strtotime(date($getdate."-".$i)) ))
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
