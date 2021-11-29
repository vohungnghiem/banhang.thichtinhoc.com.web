<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Congno;
class VhnCongnoController extends Controller
{
    public function index() {
        // $congnos = Congno::all();
        // $congnos =DB::table('vhn_hoadon_scs')
        //     ->leftJoin('vhn_hd_kiemtras','vhn_hd_kiemtras.id_hd','=','vhn_hoadon_scs.id')
        //     ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
        //     ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
        //     ->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.status','>=',4]])
        //     ->select(
        //         'vhn_hoadon_scs.*',
        //         DB::raw("SUM( vhn_hd_kiemtras.fee + vhn_hd_suachuas.price + vhn_hd_suachuas.fee + vhn_hd_sanphams.total ) AS congno"),
        //     )
        //     ->groupBy('vhn_hoadon_scs.id_congno')
        //     ->orderBy('vhn_hoadon_scs.id_congno','desc')->get();
        $congnos = DB::table('vhn_congnos')
            ->leftJoin('vhn_hoadon_scs','vhn_hoadon_scs.id_congno','=','vhn_congnos.id')
            ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.status','>=',4]])
            ->select(
                'vhn_congnos.*',
                'vhn_hoadon_scs.ngay_congno',
                'vhn_hd_suachuas.price',
                'vhn_hd_sanphams.total as totalsp',
            )
            ->groupBy('vhn_congnos.id')
            ->get();
        // dd($congnos);
        return view('admincp.congnos.index',compact('congnos'));
    }
    public function create() {
        return view('admincp.congnos.create');
    }
    public function store(Request $request) {
        try {
            $congno = new Congno;
            $congno->name = $request->name;
            $congno->sort = $request->sort;
            $congno->status = ($request->status == 'on' ? 1 : 0);
            $congno->created_at = date("Y-m-d H:i:s");
            $congno->updated_at = date("Y-m-d H:i:s");
            $congno->save();
            return redirect('congnos/edit/'.$congno->id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $congno = Congno::find($id);
            return view('admincp.congnos.edit',compact('congno'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $congno = Congno::find($id);
            $congno->name = $request->name;
            $congno->sort = $request->sort;
            $congno->status = ($request->status == 'on' ? 1 : 0);
            $congno->updated_at = date("Y-m-d H:i:s");
            $congno->save();
            return redirect('congnos/edit/'.$id)->with('success','Success!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function congno(Request $request) {
        try {
            $congnos = DB::table('vhn_hoadon_scs')->where([['id_congno',$request->id],['status',4]])->get();
            foreach ($congnos as $item) {
                if ($item->ngay_congno != null) {
                    DB::table('vhn_hoadon_scs')
                        ->where([['id',$item->id],['status',4]])
                        ->update(['ngay_congno' => null]);
                }else{
                    DB::table('vhn_hoadon_scs')
                    ->where([['id',$item->id],['status',4]])
                    ->update(['ngay_congno' => date('Y-m-d')]);
                }
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
    public function status(Request $request){
        try {
            $congno = Congno::find($request->id);
            $congno->status = ($congno->status == 1) ? 0 : 1;
            $congno->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $congno = Congno::find($request->id);
            $congno->delete();
            return response()->json('success');

        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }
}
