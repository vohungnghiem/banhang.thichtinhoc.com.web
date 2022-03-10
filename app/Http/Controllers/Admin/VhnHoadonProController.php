<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class VhnHoadonProController extends Controller
{
    public function index() {
        $hoadonpros = DB::table('vhn_hoadon_pros')->get();
        return view('admincp.hoadonpros.index',compact('hoadonpros'));
    }
    public function create() {
        $products = DB::table('vhn_products')->where('quantity','>',0)->get();
        $congnos = DB::table('vhn_congnos')->get();
        $hdgiamgias = DB::table('vhn_giamgias')->get();
        return view('admincp.hoadonpros.create',compact('products','congnos','hdgiamgias'));
    }
    public function store(Request $request) {
        try {
            $mahoadon = DB::table('vhn_hoadon_pros')->latest()->first();
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
            $id = DB::table('vhn_hoadon_pros')->insertGetId(
                [
                    'mahoadon' => $mahoadon,
                    'thoigian' => date('Y-m-d',strtotime($request->thoigian)),
                    'tenkh' => $request->tenkh,
                    'diachi' => $request->diachi,
                    'sdt' => $request->sdt,
                    'id_congno' => $id_congno,
                    'sort' => $request->sort,
                    'status' => $request->status == 'on' ? 1 : 0,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]
            );
            if (isset($request->hd_sanpham) && $request->hd_sanpham != null) {
                foreach ($request->hd_sanpham as $key => $item) {
                    $product = DB::table('vhn_products')->where('id',$item['id'])->first();
                    if ($item['quantity'] > $product->quantity) {
                        return redirect()->back()->with('quantity','Error quantity!');
                    }else{
                        $quantity = $product->quantity - $item['quantity'];
                        DB::table('vhn_products')->where('id', $item['id'])->update(['quantity' => $quantity]);
                    }
                    $gianhap = $item['gianhap'] ? str_replace([' ',',','_'], '', $item['gianhap']) : 0;// giá nhập
                    DB::table('vhn_hd_sanphams')->insert([
                        'id_hd' => $id,
                        'id_type' => 'pro',
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
            if (isset($request->dh_tunhap) != null) {
                foreach ($request->dh_tunhap as $key => $item) {
                    DB::table('vhn_hd_tunhaps')->insert([
                        'id_hd' => $id,
                        'stt' => $key,
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'] ? str_replace([' ',',','_'], '', $item['price']) : 0
                    ]);
                }
            }
            return redirect('hoadonpros/edit/'.$id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $checked = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','pro']])->pluck("id_sp")->toArray();
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
                ->get(); // kiểm tra sản phẩm còn hàng
            $congnos = DB::table('vhn_congnos')->get();
            $hoadonpro = DB::table('vhn_hoadon_pros')->where('id',$id)->first();
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','pro']])->get();

            $hdtunhaps = DB::table('vhn_hd_tunhaps')->where('id_hd',$id)->get();
            $hdgiamgias = DB::table('vhn_giamgias')->get();
            return view('admincp.hoadonpros.edit',compact('products','congnos','hoadonpro','hdsanphams','hdtunhaps','hdgiamgias'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function show($id) {
        try {
            $products = DB::table('vhn_products')->get();
            $hoadonpro = DB::table('vhn_hoadon_pros')->where('id',$id)->first();
            $hdsanphams = DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','pro']])->get();
            $hdtunhaps = DB::table('vhn_hd_tunhaps')->where('id_hd',$id)->get();
            return view('admincp.hoadonpros.show',compact('products','hoadonpro','hdsanphams','hdtunhaps'));
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
            DB::table('vhn_hoadon_pros')
                ->where('id', $id)
                ->update([
                    'thoigian' => date('Y-m-d',strtotime($request->thoigian)),
                    'tenkh' => $request->tenkh,
                    'diachi' => $request->diachi,
                    'sdt' => $request->sdt,
                    'id_congno' => $id_congno,
                    'sort' => $request->sort,
                    'status' => $request->status == 'on' ? 1 : 0,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

            $products = DB::table('vhn_hd_sanphams')->where('id_hd',$id)->get();
            foreach ($products as $item) {
                $quansp = DB::table('vhn_products')->where('id', $item->id_sp)->first()->quantity;
                $quan = $quansp + $item->quantity;
                DB::table('vhn_products')->where('id', $item->id_sp)->update(['quantity' => $quan]);
            }
            DB::table('vhn_hd_sanphams')->where([['id_hd',$id],['id_type','pro']])->delete();
            if (isset($request->hd_sanpham) && $request->hd_sanpham != null) {
                foreach ($request->hd_sanpham as $key => $item) {
                    $product = DB::table('vhn_products')->where('id',$item['id'])->first();
                    if ($item['quantity'] > $product->quantity) {
                        return redirect()->back()->with('quantity','Error quantity!');
                    }else{
                        $quantity = $product->quantity - $item['quantity'];
                        DB::table('vhn_products')->where('id', $item['id'])->update(['quantity' => $quantity]);
                    }
                    $gianhap = $item['gianhap'] ? str_replace([' ',',','_'], '', $item['gianhap']) : 0;// giá nhập
                    DB::table('vhn_hd_sanphams')->insert([
                        'id_hd' => $id,
                        'id_type' => 'pro',
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

            DB::table('vhn_hd_tunhaps')->where('id_hd',$id)->delete();
            if (isset($request->dh_tunhap) != null) {
                foreach ($request->dh_tunhap as $key => $item) {
                    DB::table('vhn_hd_tunhaps')->insert([
                        'id_hd' => $id,
                        'stt' => $key,
                        'name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'] ? str_replace([' ',',','_'], '', $item['price']) : 0
                    ]);
                }
            }

            return redirect('hoadonpros/edit/'.$id)->with('success','Success!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function status(Request $request){
        try {
            $stt = DB::table('vhn_hoadon_pros')->where('id', $request->id)->first();
            $status = ($stt->status == 1) ? 0 : 1;
            DB::table('vhn_hoadon_pros')->where('id', $request->id)->update(['status' => $status]);
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $products = DB::table('vhn_hd_sanphams')->where([['id_hd',$request->id],['id_type','pro']])->get();
            foreach ($products as $item) {
                $quansp = DB::table('vhn_products')->where('id', $item->id_sp)->first()->quantity;
                $quan = $quansp + $item->quantity;
                DB::table('vhn_products')->where('id', $item->id_sp)->update(['quantity' => $quan]);
                DB::table('vhn_hd_sanphams')->where([['id_hd',$request->id],['id_type','pro']])->delete();
            }
            DB::table('vhn_hoadon_pros')->where('id', $request->id)->delete();
            return response()->json('success');

        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }

    public function ajax($id) {
        $item = DB::table('vhn_products')->where('id',$id)->first();
        $date1= date_create($item->date_import);
        $date2= date_create(date('d-m-Y'));
        $diff = date_diff($date1,$date2)->format("%y") * 12 + date_diff($date1,$date2)->format("%m");
        $bh = ($item->warranty - $diff < 0) ? 0 : $item->warranty - $diff;
        return response()->json([$bh,$item]);
    }
}
