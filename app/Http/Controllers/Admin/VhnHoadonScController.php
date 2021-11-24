<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VhnHoadonScController extends Controller
{
    public function index() {
        $hoadonscs = DB::table('vhn_hoadon_scs')->get();
        return view('admincp.hoadonscs.index',compact('hoadonscs'));
    }
    public function create() {
        $products = DB::table('vhn_products')->get();
        $congnos = DB::table('vhn_suppliers')->get();
        return view('admincp.hoadonscs.create',compact('products','congnos'));
    }
    public function store(Request $request) {
        try {
            $mahoadon = DB::table('vhn_hoadon_scs')->latest()->first();
            $mahoadon = isset($mahoadon->mahoadon) ? $mahoadon->mahoadon + 1  : 1;
            $id = DB::table('vhn_hoadon_scs')->insertGetId(
                [
                    'mahoadon' => $mahoadon,
                    'thoigian' => date('Y-m-d',strtotime($request->thoigian)),
                    'ngaytra' => date('Y-m-d',strtotime("+$request->ngaytra day",strtotime($request->thoigian))),
                    'tenkh' => $request->tenkh,
                    'diachi' => $request->diachi,
                    'sdt' => $request->sdt,
                    'email' => $request->email,
                    'dulieucangiu' => $request->dulieucangiu,
                    'loaidichvu' => $request->loaidichvu,
                    'sort' => $request->sort,
                    'status' => $request->status,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );
            if (isset($request->hd_sanpham) && $request->hd_sanpham != null) {
                foreach ($request->hd_sanpham as $key => $item) {
                    $product = DB::table('vhn_products')->where('id',$item['id'])->first();
                    if ($item['quantity'] > $product->quantity) {
                        return redirect()->back()->with('quantity','Error quantity!'); // chua co tao alert
                    }else{
                        $quantity = $product->quantity - $item['quantity'];
                        DB::table('vhn_products')->where('id', $item['id'])->update(['quantity' => $quantity]);
                    }
                    DB::table('vhn_hd_sanphams')->insert([
                        'id_hd' => $id,
                        'id_type' => 'sc',
                        'stt' => $key,
                        'id_sp' => $product->id,
                        'name' => $product->name,
                        'quantity' => $item['quantity'],
                        'price' => $product->price_sale,
                        'total' => $item['quantity'] * $product->price_sale,
                        'warranty' => $item['warranty']
                    ]);
                }
            }
            if (isset($request->dh_kiemtra) != null) {
                foreach ($request->dh_kiemtra as $key => $item) {
                    DB::table('vhn_hd_kiemtras')->insert([
                        'id_hd' => $id,
                        'stt' => $key,
                        'name' => $item['name'],
                        'benhtrang' => $item['benhtrang'],
                        'dexuat' => $item['dexuat'],
                        'ghichu' => $item['ghichu'],
                        'fee' => 0
                    ]);
                }
            }
            if (isset($request->dh_suachua) != null) {
                foreach ($request->dh_suachua as $key => $item) {
                    DB::table('vhn_hd_suachuas')->insert([
                        'id_hd' => $id,
                        'stt' => $key,
                        'name' => $item['name'],
                        'price' => $item['price'] ? str_replace([' ',',','_'], '', $item['price']) : 0,
                        // 'fee' => $item['fee'] ? str_replace([' ',',','_'], '', $item['fee']) : 0,
                        'id_congno' => $item['id_congno']
                    ]);
                }
            }
            return redirect('hoadonscs/edit/'.$id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $products = DB::table('vhn_products')->get();
            $congnos = DB::table('vhn_suppliers')->get();
            $hoadonsc = DB::table('vhn_hoadon_scs')->where('id',$id)->first();
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->get();
            $hdkiemtras = DB::table('vhn_hd_kiemtras')->where('id_hd',$id)->get();
            $hdsuachuas = DB::table('vhn_hd_suachuas')->where('id_hd',$id)->get();
            return view('admincp.hoadonscs.edit',compact('products','congnos','hoadonsc','hdsanphams','hdkiemtras','hdsuachuas'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function show($id) {
        try {
            $products = DB::table('vhn_products')->get();
            $hoadonsc = DB::table('vhn_hoadon_scs')->where('id',$id)->first();
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->get();
            $hdkiemtras = DB::table('vhn_hd_kiemtras')->where('id_hd',$id)->get(); //dd($hdkiemtras);
            $hdsuachuas = DB::table('vhn_hd_suachuas')->where('id_hd',$id)->get();
            return view('admincp.hoadonscs.show',compact('products','hoadonsc','hdsanphams','hdkiemtras','hdsuachuas'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function showkh($id) {
        try {
            $arrid = explode("_", $id);
            $products = DB::table('vhn_products')->get();
            $hoadonsc = DB::table('vhn_hoadon_scs')->where([ ['id',$arrid[0]] , ['sdt',$arrid[1] ]])->first();
            if (!$hoadonsc) {
                return redirect()->back()->with('error','Error!');
            }
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->get();
            $hdkiemtras = DB::table('vhn_hd_kiemtras')->where('id_hd',$id)->get(); //dd($hdkiemtras);
            $hdsuachuas = DB::table('vhn_hd_suachuas')->where('id_hd',$id)->get();
            return view('admincp.hoadonscs.showkh',compact('products','hoadonsc','hdsanphams','hdkiemtras','hdsuachuas'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            DB::table('vhn_hoadon_scs')
                ->where('id', $id)
                ->update([
                    'thoigian' => date('Y-m-d',strtotime($request->thoigian)),
                    'ngaytra' => date('Y-m-d',strtotime($request->ngaytra)),
                    'tenkh' => $request->tenkh,
                    'diachi' => $request->diachi,
                    'sdt' => $request->sdt,
                    'email' => $request->email,
                    'dulieucangiu' => $request->dulieucangiu,
                    'loaidichvu' => $request->loaidichvu,
                    'sort' => $request->sort,
                    'status' => $request->status,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

            DB::table('vhn_hd_suachuas')->where('id_hd',$id)->delete();
            if (isset($request->dh_suachua) != null) {
                foreach ($request->dh_suachua as $key => $item) {
                    DB::table('vhn_hd_suachuas')->insert([
                        'id_hd' => $id,
                        'stt' => $key,
                        'name' => $item['name'],
                        'price' => $item['price'] ? str_replace([' ',',','_'], '', $item['price']) : 0,
                        // 'fee' => $item['fee'] ? str_replace([' ',',','_'], '', $item['fee']) : 0,
                        'id_congno' => $item['id_congno']
                    ]);
                }
            }
            DB::table('vhn_hd_kiemtras')->where('id_hd',$id)->delete();
            if (isset($request->dh_kiemtra) != null) {
                foreach ($request->dh_kiemtra as $key => $item) {
                    DB::table('vhn_hd_kiemtras')->insert([
                        'id_hd' => $id,
                        'stt' => $key,
                        'name' => $item['name'],
                        'benhtrang' => $item['benhtrang'],
                        'dexuat' => $item['dexuat'],
                        'ghichu' => $item['ghichu'],
                        'fee' => 0
                    ]);
                }
            }
            $products = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->get();
            foreach ($products as $item) {
                $quansp = DB::table('vhn_products')->where('id', $item->id_sp)->first()->quantity;
                $quan = $quansp + $item->quantity;
                DB::table('vhn_products')->where('id', $item->id_sp)->update(['quantity' => $quan]);
            }
            DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->delete();
            if (isset($request->hd_sanpham) && $request->hd_sanpham != null) {
                foreach ($request->hd_sanpham as $key => $item) {
                    $product = DB::table('vhn_products')->where('id',$item['id'])->first();
                    if ($item['quantity'] > $product->quantity) {
                        return redirect()->back()->with('quantity','Error quantity!');
                    }else{
                        $quantity = $product->quantity - $item['quantity'];
                        DB::table('vhn_products')->where('id', $item['id'])->update(['quantity' => $quantity]);
                    }
                    DB::table('vhn_hd_sanphams')->insert([
                        'id_hd' => $id,
                        'id_type' => 'sc',
                        'stt' => $key,
                        'id_sp' => $product->id,
                        'name' => $product->name,
                        'quantity' => $item['quantity'],
                        'price' => $product->price_sale,
                        'total' => $item['quantity'] * $product->price_sale,
                        'warranty' => $item['warranty']
                    ]);
                }
            }
            return redirect('hoadonscs/edit/'.$id)->with('success','Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function status(Request $request){
        try {
            $setpercent = DB::table('vhn_setups')->where('name','percent')->first();
            if ($request->status == 4) {
                $percentprice = DB::table('vhn_hd_suachuas')->where('vhn_hd_suachuas.id_hd',$request->id)->sum('vhn_hd_suachuas.price');
                $loinhuan = round(($setpercent->value / 100) * $percentprice, -3);
            }else{
                $loinhuan = 0;
            }
            DB::table('vhn_hoadon_scs')->where('id', $request->id)->update(['status' => $request->status,'loinhuan' => $loinhuan]);
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function loinhuan(Request $request, $id){
        try {
            DB::table('vhn_hoadon_scs')->where('id', $id)->update(['loinhuan' => $request->loinhuan]);
            return redirect()->back()->with('success','Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function ghichu(Request $request, $id){
        try {
            DB::table('vhn_hoadon_scs')->where('id', $id)->update(['ghichu' => $request->ghichu]);
            return redirect()->back()->with('success','Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $products = DB::table('vhn_hd_sanphams')->where([['id_hd',$request->id],['id_type','sc']])->get();
            foreach ($products as $item) {
                $quansp = DB::table('vhn_products')->where('id', $item->id_sp)->first()->quantity;
                $quan = $quansp + $item->quantity;
                DB::table('vhn_products')->where('id', $item->id_sp)->update(['quantity' => $quan]);
                DB::table('vhn_hd_sanphams')->where([['id_hd',$request->id],['id_type','sc']])->delete();
            }
            DB::table('vhn_hoadon_scs')->where('id', $request->id)->delete();
            return response()->json('success');

        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }
}
