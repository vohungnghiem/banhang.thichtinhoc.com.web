<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\VhnImageController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Phieu;
use Illuminate\Support\Str;//
use Illuminate\Support\Facades\Storage;//
class VhnPhieuController extends Controller
{
    public function index() {
        $phieus = Phieu::orderBy('id','desc')->get();
        return view('admincp.phieus.index',compact('phieus'));
    }
    public function create() {
        return view('admincp.phieus.create');
    }
    public function store(Request $request) {
        try {
            $phieu = new Phieu;
            $phieu->name = $request->name;
            $phieu->type = $request->type;
            $phieu->fee = $request->fee ? str_replace([' ',',','_'], '', $request->fee) : 0;
            $phieu->date_import = date('Y-m-d',strtotime($request->date_import));
            $phieu->sort = $request->sort;
            $phieu->status = ($request->status == 'on' ? 1 : 0);
            $phieu->idrut = $request->idrut;
            $phieu->created_at = date("Y-m-d H:i:s");
            $phieu->updated_at = date("Y-m-d H:i:s");
            $phieu->save();

            $myclass = new VhnImageController;
            $phieu->file = $myclass->saveFile($request,'phieus',$phieu->created_at);
            $phieu->save();
            return redirect('phieus/edit/'.$phieu->id)->with('success','Success !');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function edit($id) {
        try {
            $phieu = Phieu::find($id);
            return view('admincp.phieus.edit',compact('phieu'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $phieu = Phieu::find($id);
            $phieu->name = $request->name;
            $phieu->name = $request->name;
            $phieu->type = $request->type;
            $phieu->fee = $request->fee ? str_replace([' ',',','_'], '', $request->fee) : 0;
            $phieu->date_import = date('Y-m-d',strtotime($request->date_import));
            $phieu->sort = $request->sort;
            $phieu->status = ($request->status == 'on' ? 1 : 0);
            $phieu->idrut = $request->idrut;
            $phieu->updated_at = date("Y-m-d H:i:s");
            $phieu->save();
            $myclass = new VhnImageController;
            $phieu->file = $myclass->saveFile($request,'phieus',$phieu->created_at);
            $phieu->save();
            return redirect('phieus/edit/'.$id)->with('success','Success!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Error!');
        }
    }
    public function remove_img(Request $request){
        try {
            $phieu = Phieu::find($request->id);
            Storage::disk('public')->delete(storage_link('phieu',$phieu->created_at).$phieu->file);
            $phieu->file = NULL;
            $phieu->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function status(Request $request){
        try {
            $phieu = Phieu::find($request->id);
            $phieu->status = ($phieu->status == 1) ? 0 : 1;
            $phieu->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function sort(Request $request){
        try {
            $phieu = Phieu::find($request->id);
            $phieu->sort = $request->sort;
            $phieu->save();
            return response()->json('success');
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            $phieu = Phieu::find($request->id);
            $phieu->delete();
            return response()->json('success');

        } catch (\Throwable $th) {
            return response()->json('error');
        }

    }
}
