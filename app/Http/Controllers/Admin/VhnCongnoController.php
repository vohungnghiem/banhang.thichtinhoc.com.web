<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Congno;
class VhnCongnoController extends Controller
{
    public function index() {
        $congno1 = DB::table('vhn_congnos')
            ->leftJoin('vhn_hoadon_scs','vhn_hoadon_scs.id_congno','=','vhn_congnos.id')
            ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
            ->leftjoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
            ->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.status','>=',4]])
            // ->distinct()
            ->select(
                'vhn_congnos.*',
                'vhn_hoadon_scs.ngay_congno',
                DB::raw("(CASE WHEN vhn_hoadon_scs.ngay_congno IS NULL THEN 0 ELSE 1 END ) AS ngaynull"),
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.id_hd,'_',vhn_hd_sanphams.stt,'-' , vhn_hd_sanphams.total , '-', vhn_hd_sanphams.id_type) as congnosp"),
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_suachuas.stt , '-' , vhn_hd_suachuas.price, '-' , vhn_hd_suachuas.id_hd ) as congno"),
                DB::raw("GROUP_CONCAT(vhn_giamgias.giamgia) as giamgia"),
                // DB::raw("GROUP_CONCAT(DISTINCT vhn_congnos.id,'_',vhn_hoadon_scs.id_congno) as dis"),
                DB::raw("CONCAT('suachua') as loai"),
            )
            ->groupBy('vhn_congnos.id','vhn_hoadon_scs.ngay_congno')
            ->orderBy('ngaynull','asc')
            ->orderBy('vhn_hoadon_scs.ngay_congno','desc')
            ->get();
        // dd($congnos);
        $congno2 = DB::table('vhn_congnos')
            ->leftJoin('vhn_hoadon_pros','vhn_hoadon_pros.id_congno','=','vhn_congnos.id')
            ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
            ->leftjoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
            ->where([['vhn_hoadon_pros.id_congno','>',0],['vhn_hoadon_pros.status','>=',1],['vhn_hd_sanphams.id_type','pro']])
            // ->distinct()
            ->select(
                'vhn_congnos.*',
                'vhn_hoadon_pros.ngay_congno',
                DB::raw("(CASE WHEN vhn_hoadon_pros.ngay_congno IS NULL THEN 0 ELSE 1 END ) AS ngaynull"),
                DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.id_hd,'_',vhn_hd_sanphams.stt,'-' , vhn_hd_sanphams.total , '-', vhn_hd_sanphams.id_type) as congnosp"),
                DB::raw("GROUP_CONCAT(NULL) as congno"),
                DB::raw("GROUP_CONCAT(vhn_giamgias.giamgia) as giamgia"),
                // DB::raw("GROUP_CONCAT( vhn_congnos.id,'_',vhn_hoadon_pros.id_congno) as dis"),
                DB::raw("CONCAT('sanpham') as loai"),
            )
            ->groupBy('vhn_congnos.id','vhn_hoadon_pros.ngay_congno')
            ->orderBy('ngaynull','asc')
            ->orderBy('vhn_hoadon_pros.ngay_congno','desc')
            ->get();
        $congnos = $congno1->merge($congno2)->sortByDesc('created_at');
        // dd($congnos);

        return view('admincp.congnos.index',compact('congnos'));
    }
    public function list($id,$date,$loai) {
        try {
            if ($date == 'null') {
                $date = null;
            }
            if ($loai == "suachua") {
                $listscs = DB::table('vhn_congnos')
                ->leftJoin('vhn_hoadon_scs','vhn_hoadon_scs.id_congno','=','vhn_congnos.id')
                ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_scs.id')
                ->leftjoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
                ->where([['vhn_hoadon_scs.id_congno','>',0],['vhn_hoadon_scs.status','>=',4],['vhn_hoadon_scs.ngay_congno',$date]])
                ->where('vhn_congnos.id',$id)
                ->select(
                    'vhn_hoadon_scs.thoigian',
                    'vhn_hoadon_scs.tenkh',
                    'vhn_hoadon_scs.mahoadon',
                    DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_suachuas.name , '@@' , vhn_hd_suachuas.price) as congno"),
                    DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.stt ,'-' , vhn_hd_sanphams.total , '-', vhn_hd_sanphams.id_type, '-', vhn_hd_sanphams.name) as congnosp"),
                    DB::raw("GROUP_CONCAT(DISTINCT vhn_giamgias.giamgia) as giamgia"),
                    DB::raw("CONCAT('suachua') as loai"),
                )
                ->groupBy('vhn_hoadon_scs.id','vhn_hoadon_scs.thoigian','vhn_giamgias.giamgia')
                ->get();
            } else {
                $listscs = DB::table('vhn_congnos')
                ->leftJoin('vhn_hoadon_pros','vhn_hoadon_pros.id_congno','=','vhn_congnos.id')
                // ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_hd','=','vhn_hoadon_scs.id')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.id_hd','=','vhn_hoadon_pros.id')
                ->leftjoin('vhn_giamgias','vhn_giamgias.code','=','vhn_hd_sanphams.giamgia')
                ->where([['vhn_hoadon_pros.id_congno','>',0],['vhn_hoadon_pros.ngay_congno',$date],['vhn_hd_sanphams.id_type','pro']])
                ->where('vhn_congnos.id',$id)
                ->select(
                    'vhn_hoadon_pros.thoigian',
                    'vhn_hoadon_pros.tenkh',
                    'vhn_hoadon_pros.mahoadon',
                    // DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_suachuas.name , '@@' , vhn_hd_suachuas.price) as congno"),
                    DB::raw("GROUP_CONCAT(NULL) as congno"),
                    DB::raw("GROUP_CONCAT(DISTINCT vhn_hd_sanphams.stt ,'-' , vhn_hd_sanphams.total , '-', vhn_hd_sanphams.id_type, '-', vhn_hd_sanphams.name) as congnosp"),
                    DB::raw("GROUP_CONCAT(DISTINCT vhn_giamgias.giamgia) as giamgia"),
                    DB::raw("CONCAT('sanpham') as loai"),
                )
                ->groupBy('vhn_hoadon_pros.id','vhn_hoadon_pros.thoigian','vhn_giamgias.giamgia')
                ->get();
            }


            // dd($listscs);
            $congno = DB::table('vhn_congnos')->where('id',$id)->first();
            return view('admincp.congnos.list',compact('listscs','congno','date','loai'));
        } catch (\Throwable $th) {
            return response()->json('error');
        }
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
            if ($request->loai == "suachua") {
                $congnos = DB::table('vhn_hoadon_scs')->where([['id_congno',$request->id],['status',4],['ngay_congno', '=', $request->date]])->get();
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
            } else {
                $congnos = DB::table('vhn_hoadon_pros')->where([['id_congno',$request->id],['status',1],['ngay_congno', '=', $request->date]])->get();
                foreach ($congnos as $item) {
                    if ($item->ngay_congno != null) {
                        DB::table('vhn_hoadon_pros')
                            ->where([['id',$item->id],['status',1]])
                            ->update(['ngay_congno' => null]);
                    }else{
                        DB::table('vhn_hoadon_pros')
                        ->where([['id',$item->id],['status',1]])
                        ->update(['ngay_congno' => date('Y-m-d')]);
                    }
                }
            }
            return response()->json('success');
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
