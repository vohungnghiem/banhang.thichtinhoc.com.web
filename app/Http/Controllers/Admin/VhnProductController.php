<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\VhnImageController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Str;//
use Illuminate\Support\Facades\Storage;//
class VhnProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('id','desc')->get();
        return view('admincp.products.index',compact('products'));
    }
    public function create() {
        $suppliers = Supplier::where('status',1)->get();
        return view('admincp.products.create',compact('suppliers'));
    }
    public function store(Request $request) {
        try {
            $product = new Product;
            $product->name = $request->name;
            $product->quantity = $request->quantity;
            $product->price_sale = $request->price_sale ? str_replace([' ',',','_'], '', $request->price_sale) : 0;
            $product->price_import = $request->price_sale ? str_replace([' ',',','_'], '', $request->price_import) : 0;
            $product->date_import = date('Y-m-d',strtotime($request->date_import));
            $product->id_supplier = $request->id_supplier;
            $product->warranty = $request->warranty;
            $product->location = $request->location;
            $product->sort = $request->sort;
            $product->status = ($request->status == 'on' ? 1 : 0);
            $product->created_at = date("Y-m-d H:i:s");
            $product->updated_at = date("Y-m-d H:i:s");
            $product->save();

            $myclass = new VhnImageController;
            $product->image = $myclass->saveImgProduct($request,'product',$product->created_at);
            $product->location_image = $myclass->saveImgLocation($request,'location',$product->created_at);
            $product->save();
            return redirect('products/edit/'.$product->id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $product = Product::find($id);
            $suppliers = Supplier::where('status',1)->get();
            return view('admincp.products.edit',compact('product','suppliers'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            $product->name = $request->name;
            if ($product->quantity != $request->quantity) {
                DB::table('vhn_logsps')->insert(
                    ['id_pro' => $id, 'socu' => $product->quantity,'somoi'=>$request->quantity,'ngaytao'=>date('Y-m-d')]
                );
            }
            $product->quantity = $request->quantity;
            $product->price_sale = $request->price_sale ? str_replace([' ',',','_'], '', $request->price_sale) : 0;
            $product->price_import = $request->price_sale ? str_replace([' ',',','_'], '', $request->price_import) : 0;
            $product->date_import = date('Y-m-d',strtotime($request->date_import));
            $product->id_supplier = $request->id_supplier;
            $product->warranty = $request->warranty;
            $product->location = $request->location;
            $product->sort = $request->sort;
            $product->status = ($request->status == 'on' ? 1 : 0);
            $product->updated_at = date("Y-m-d H:i:s");
            $product->save();
            $myclass = new VhnImageController;
            $product->image = $myclass->saveImgProduct($request,'product',$product->created_at);
            $product->location_image = $myclass->saveImgLocation($request,'location',$product->created_at);
            $product->save();
            return redirect('products/edit/'.$id)->with('success','Success!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function remove_img(Request $request){
        try {
            $product = Product::find($request->id);
            Storage::disk('public')->delete(storage_link('product',$product->created_at).$product->image);
            $product->image = NULL;
            $product->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function remove_img_location(Request $request){
        try {
            $product = Product::find($request->id);
            Storage::disk('public')->delete(storage_link('location',$product->created_at).$product->location_image);
            $product->location_image = NULL;
            $product->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function status(Request $request){
        try {
            $product = Product::find($request->id);
            $product->status = ($product->status == 1) ? 0 : 1;
            $product->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function sort(Request $request){
        try {
            $product = Product::find($request->id);
            $product->sort = $request->sort;
            $product->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $product = Product::find($request->id);
            $product->delete();
            return response()->json('success');

        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }
    public function viewhd(Request $request)
    {
        try {
            $ds = DB::table('vhn_hd_sanphams')
                ->leftJoin('vhn_hoadon_pros', function($join)
                {
                    $join->on('vhn_hoadon_pros.id', '=', 'vhn_hd_sanphams.id_hd');
                    $join->where('vhn_hd_sanphams.id_type','=', 'pro');
                })
                ->leftJoin('vhn_hoadon_scs', function($joinn)
                {
                    $joinn->on('vhn_hoadon_scs.id', '=', 'vhn_hd_sanphams.id_hd');
                    $joinn->where('vhn_hd_sanphams.id_type','=', 'sc');
                })
                ->where('vhn_hd_sanphams.id_sp','=',$request->id)
                ->select('vhn_hd_sanphams.*','vhn_hoadon_pros.mahoadon as mahoadonpro','vhn_hoadon_scs.mahoadon as mahoadonsc')
                ->get();
            return response()->json($ds);
        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }
}
