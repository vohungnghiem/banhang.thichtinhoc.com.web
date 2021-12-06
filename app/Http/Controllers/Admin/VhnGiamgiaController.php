<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Giamgia;
class VhnGiamgiaController extends Controller
{
    public function index() {
        $giamgias = Giamgia::all();
        return view('admincp.giamgias.index',compact('giamgias'));
    }
    public function create() {
        return view('admincp.giamgias.create');
    }
    public function store(Request $request) {
        try {
            $giamgia = new Giamgia;
            $giamgia->code = $request->code;
            $giamgia->giamgia = $request->giamgia ? str_replace([' ',',','_'], '', $request->giamgia) : 0;
            $giamgia->status = ($request->status == 'on' ? 1 : 0);
            $giamgia->created_at = date("Y-m-d H:i:s");
            $giamgia->updated_at = date("Y-m-d H:i:s");
            $giamgia->save();
            return redirect('giamgias/edit/'.$giamgia->id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $giamgia = Giamgia::find($id);
            return view('admincp.giamgias.edit',compact('giamgia'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $giamgia = Giamgia::find($id);
            $giamgia->code = $request->code;
            $giamgia->giamgia = $request->giamgia ? str_replace([' ',',','_'], '', $request->giamgia) : 0;
            $giamgia->status = ($request->status == 'on' ? 1 : 0);
            $giamgia->updated_at = date("Y-m-d H:i:s");
            $giamgia->save();
            return redirect('giamgias/edit/'.$id)->with('success','Success!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function status(Request $request){
        try {
            $giamgia = Giamgia::find($request->id);
            $giamgia->status = ($giamgia->status == 1) ? 0 : 1;
            $giamgia->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    // public function destroy(Request $request)
    // {
    //     try {
    //         $giamgia = giamgia::find($request->id);
    //         $giamgia->delete();
    //         return response()->json('success');

    //     } catch (\Throwable $th) {
    //         return response()->json('error');
    //     }

    // }
}
