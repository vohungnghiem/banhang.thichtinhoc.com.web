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
        $products = DB::table('vhn_products')->where('quantity','>',0)->get();
        $congnos = DB::table('vhn_congnos')->get();
        $hdgiamgias = DB::table('vhn_giamgias')->get();
        return view('admincp.hoadonscs.create',compact('products','congnos','hdgiamgias'));
    }
    public function store(Request $request) {
        try {
            $mahoadon = DB::table('vhn_hoadon_scs')->latest()->first();
            $mahoadon = isset($mahoadon->mahoadon) ? $mahoadon->mahoadon + 1  : 1;
            if ($request->add_congno) {
                $congno = DB::table('vhn_congnos')
                ->updateOrInsert(
                    ['name' => $request->add_congno],
                    ['status' => 1,'sort' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                );
                $id_congno = DB::getPdo()->lastInsertId();
            }else{
                $id_congno = $request->id_congno;
            }
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
                    'id_congno' => $id_congno,
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
                    $gianhap = $item['gianhap'] ? str_replace([' ',',','_'], '', $item['gianhap']) : 0;// gi?? nh???p
                    DB::table('vhn_hd_sanphams')->insert([
                        'id_hd' => $id,
                        'id_type' => 'sc',
                        'stt' => $key,
                        'id_sp' => $product->id,
                        'name' => $product->name,
                        'quantity' => $item['quantity'],
                        // 'price' => $product->price_sale,
                        // 'total' => $item['quantity'] * $product->price_sale,
                        'price' => $gianhap,
                        'total' => $item['quantity'] * $gianhap,
                        'warranty' => $item['warranty'],
                        'giamgia' => $item['giamgia']
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
            $checked = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->pluck("id_sp")->toArray();
		    $arrchecked = implode(",",$checked);
            $products = DB::table('vhn_products')
                // ->where('quantity','>',0)
                ->select(
                    'vhn_products.*',
                    DB::raw(' (CASE
                        WHEN FIND_IN_SET(vhn_products.id, "'.$arrchecked.'") THEN "3"
                        WHEN vhn_products.quantity  > 0 THEN "2"
                        ELSE "0"
                    END) AS has_dt')
                )
                ->get(); //ki???m tra s???n ph???m c??n h??ng
            $congnos = DB::table('vhn_congnos')->get();
            $hoadonsc = DB::table('vhn_hoadon_scs')->where('id',$id)->first();
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->get();
            $hdkiemtras = DB::table('vhn_hd_kiemtras')->where('id_hd',$id)->get();
            $hdsuachuas = DB::table('vhn_hd_suachuas')->where('id_hd',$id)->get();
            $hdgiamgias = DB::table('vhn_giamgias')->get();
            return view('admincp.hoadonscs.edit',compact('products','congnos','hoadonsc','hdsanphams','hdkiemtras','hdsuachuas','hdgiamgias'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function show($id) {
        try {
            $products = DB::table('vhn_products')->get();
            $hoadonsc = DB::table('vhn_hoadon_scs')->where('id',$id)->first();
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','sc']])->get();
            $hdkiemtras = DB::table('vhn_hd_kiemtras')->where('id_hd',$id)->get();
            $hdsuachuas = DB::table('vhn_hd_suachuas')->where('id_hd',$id)->get();
            $hdgiamgias = DB::table('vhn_giamgias')
                ->leftJoin('vhn_hd_sanphams','vhn_hd_sanphams.giamgia','=','vhn_giamgias.code')
                ->where([['id_hd',$id],['id_type','sc']])->sum('vhn_giamgias.giamgia');
            // dd($hdgiamgias);
            return view('admincp.hoadonscs.show',compact('products','hoadonsc','hdsanphams','hdkiemtras','hdsuachuas','hdgiamgias'));
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
            if ($request->add_congno) {
                $congno = DB::table('vhn_congnos')
                ->updateOrInsert(
                    ['name' => $request->add_congno],
                    ['status' => 1,'sort' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]
                );
                $id_congno = DB::getPdo()->lastInsertId();
            }else{
                $id_congno = $request->id_congno;
            }
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
                    'id_congno' => $id_congno,
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
                        // 'id_congno' => $item['id_congno']
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
                    $gianhap = $item['gianhap'] ? str_replace([' ',',','_'], '', $item['gianhap']) : 0;// gi?? nh???p
                    DB::table('vhn_hd_sanphams')->insert([
                        'id_hd' => $id,
                        'id_type' => 'sc',
                        'stt' => $key,
                        'id_sp' => $product->id,
                        'name' => $product->name,
                        'quantity' => $item['quantity'],
                        // 'price' => $product->price_sale,
                        // 'total' => $item['quantity'] * $product->price_sale,
                        'price' => $gianhap,
                        'total' => $item['quantity'] * $gianhap,
                        'warranty' => $item['warranty'],
                        'giamgia' => $item['giamgia']
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
            $setpercent = DB::table('vhn_setups')->where('name','percentsc')->first();
            if ($request->status == 4) {
                $percentprice = DB::table('vhn_hd_suachuas')->where('vhn_hd_suachuas.id_hd',$request->id)->sum('vhn_hd_suachuas.price');
                $loinhuan = round(($setpercent->value / 100) * $percentprice, -3);
                $hoivon = round(( ( 100- $setpercent->value) / 100) * $percentprice, -3);
            }else{
                $loinhuan = 0;
                $hoivon = 0;
            }
            DB::table('vhn_hoadon_scs')->where('id', $request->id)->update(['status' => $request->status,'loinhuan' => $loinhuan,'hoivon' => $hoivon]);
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
