<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Supplier;
class VhnSupplierController extends Controller
{
    public function index() {
        $suppliers = DB::table('vhn_suppliers')
            ->leftJoin('vhn_hd_suachuas','vhn_hd_suachuas.id_congno','=','vhn_suppliers.id')
            ->leftJoin('vhn_hoadon_scs','vhn_hoadon_scs.id','=','vhn_hd_suachuas.id_hd')
            ->where('vhn_suppliers.id','>',0)
            ->select(
                'vhn_suppliers.*',
                DB::raw("SUM( CASE WHEN (vhn_hoadon_scs.status = 4) AND (vhn_hd_suachuas.ngay_congno IS NULL) THEN vhn_hd_suachuas.price ELSE 0 END) AS tiencongno"),
                DB::raw('MAX(vhn_hd_suachuas.ngay_congno) as ngay_congno'),
            )
            ->groupBy('vhn_suppliers.id')
            ->orderBy('vhn_suppliers.id','asc')
            ->get();
        return view('admincp.suppliers.index',compact('suppliers'));
    }
    public function create() {
        return view('admincp.suppliers.create');
    }
    public function store(Request $request) {
        try {
            $supplier = new Supplier;
            $supplier->name = $request->name;
            $supplier->sort = $request->sort;
            $supplier->status = ($request->status == 'on' ? 1 : 0);
            $supplier->created_at = date("Y-m-d H:i:s");
            $supplier->updated_at = date("Y-m-d H:i:s");
            $supplier->save();
            return redirect('suppliers/edit/'.$supplier->id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $supplier = Supplier::find($id);
            return view('admincp.suppliers.edit',compact('supplier'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function congno(Request $request) {
        // return $request->id;
        try {
            $congno = DB::table('vhn_hd_suachuas')->leftJoin('vhn_hoadon_scs','vhn_hoadon_scs.id','=','vhn_hd_suachuas.id_hd')
            ->where([['id_congno',$request->id],['ngay_congno',null],['vhn_hoadon_scs.status',4]])->update(['ngay_congno' => date('Y-m-d')]);;
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $supplier = Supplier::find($id);
            $supplier->name = $request->name;
            $supplier->sort = $request->sort;
            $supplier->status = ($request->status == 'on' ? 1 : 0);
            $supplier->updated_at = date("Y-m-d H:i:s");
            $supplier->save();
            return redirect('suppliers/edit/'.$id)->with('success','Success!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function status(Request $request){
        try {
            $supplier = Supplier::find($request->id);
            $supplier->status = ($supplier->status == 1) ? 0 : 1;
            $supplier->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $supplier = Supplier::find($request->id);
            $supplier->delete();
            return response()->json('success');

        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }
}
