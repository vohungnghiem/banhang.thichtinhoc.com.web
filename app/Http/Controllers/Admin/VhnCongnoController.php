<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class VhnCongnoController extends Controller
{
    public function index() {
        $congnos =DB::table('vhn_hoadon_scs')
            ->leftJoin('vhn_hd_kiemtras','vhn_hd_kiemtras.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.status','>=',4]])
            ->select(
                'vhn_hoadon_scs.*','vhn_hd_kiemtras.name',
                DB::raw("SUM( vhn_hd_kiemtras.fee + vhn_hd_suachuas.price + vhn_hd_suachuas.fee + vhn_hd_sanphams.total ) AS congno"),
            )
            ->groupBy('vhn_hoadon_scs.id')
            ->orderBy('vhn_hoadon_scs.id','desc')->get();
        return view('admincp.congnos.index',compact('congnos'));
    }
    public function congno(Request $request) {
        try {
            $congno = DB::table('vhn_hoadon_scs')->where([['id',$request->id],['status',4]])->first();
            if ($congno->ngay_congno != null) {
                DB::table('vhn_hoadon_scs')
                ->where([['id',$request->id],['status',4]])
                ->update(['ngay_congno' => null]);
            }else{
                DB::table('vhn_hoadon_scs')
                ->where([['id',$request->id],['status',4]])
                ->update(['ngay_congno' => date('Y-m-d')]);
            }

            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function list($id) {
        try {
            $hoadonsc = DB::table('vhn_hoadon_scs')->where('id',$id)->first();
            $listsc =DB::table('vhn_hd_suachuas')
                ->where('vhn_hd_suachuas.id_hd',$id)
                ->get();
            $listsp = DB::table('vhn_hd_sanphams')
                ->where('vhn_hd_sanphams.id_hd',$id)
                ->where('vhn_hd_sanphams.id_type','sc')
                ->get();
            return view('admincp.congnos.list',compact('hoadonsc','listsc','listsp'));
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }

}
