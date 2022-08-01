<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\VhnImageController; //Class của tôi
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;//
use Illuminate\Support\Facades\Storage;//
use App\Models\User;
class AccountController extends Controller
{
    public function index()
    {
        $accounts = DB::table('users')->get();
        return view('admincp.account.index',['accounts'=>$accounts]);
    }
    public function create()
    {
        return view('admincp.account.create');
    }
    public function store(Request $request)
    {
        try {
            if (Auth::user()->hasAnyRole(['super-admin|admin']) || Auth::user()->id <= $request->level ) {
                $account = new User;
                $account->email = $request->email;
                $account->password = bcrypt($request->password);

                $account->name = $request->name;
                $account->level = $request->level;
                $account->phone = $request->phone;
                $account->status = ($request->status == 'on' ? 1 : 0);
                $account->created_at = date("Y-m-d H:i:s");
                $account->updated_at = date("Y-m-d H:i:s");
                $account->save();

                $myclass = new VhnImageController;
                $account->avatar = $myclass->saveImg($request,'account',$account->created_at);
                $account->save();
                return redirect('account/edit/'.$account->id)->with('success','Success !');
            } else {
                return redirect()->back()->with('permission');
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error');
        }
    }

    public function edit($id)
    {
        try {
            $account = User::find($id);
            return view('admincp.account.edit',['account'=>$account]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error');
        }

    }

    public function update(AccountRequest $request, $id)
    {
        try {
            if (Auth::user()->hasAnyRole(['super-admin']) || $id == Auth::user()->id) {
                $account = User::find($id);
                if ($request->email != $request->oldemail) {
                    $account->email = $request->email;
                }
                if ($request->password != null) {
                    $account->password = bcrypt($request->password);
                }
                $account->name = $request->name;
                $account->level = $request->level;
                $account->phone = $request->phone;
                $account->status = ($request->status == 'on' ? 1 : 0);
                $account->updated_at = date("Y-m-d H:i:s");
                // avatar
                $myclass = new VhnImageController;
                $account->avatar = $myclass->saveImg($request,'account',$account->created_at);
                $account->save();

                return redirect('account/edit/'.$id)->with('success','Success !');
            } else {
                return redirect()->back()->with('permission','Tài khoản không có quyền chỉnh sửa!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Tài khoản không có quyền chỉnh sửa!');
        }
    }

    public function status(Request $request){
        try {
            if (Auth::user()->hasAnyRole(['super-admin|admin']) || $request->id == Auth::user()->id) {
                if( $request->id == 1){
                    return response()->json('warning');
                }
                else{
                    $account = User::find($request->id);
                    $account->status = ($account->status == 1) ? 0 : 1;
                    $account->save();
                    return response()->json('success');
                }
            }else{
                return response()->json('permission');
            }
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }

    public function remove_img(Request $request){
        try {
            if (Auth::user()->hasAnyRole(['super-admin']) || $request->id == Auth::user()->id) {
                $account = User::find($request->id);
                Storage::disk('public')->delete(storage_link('account',$account->created_at).$account->avatar);
                return response()->json('success');
            }else{
                return response()->json('permission');
            }
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
    public function destroy(Request $request)
    {
        try {
            if ( Auth::user()->hasAnyRole(['super-admin']) ) {
                if($request->id == 1){
                    return response()->json('warning');
                }else{
                    $account = User::find($request->id);
                    Storage::disk('public')->delete(storage_link('account',$account->created_at).$account->avatar);
                    DB::table('users')->where('id', $account->id)->delete();

                    return response()->json('success');
                }
            } else {
                return response()->json('permission');
            }
        } catch (\Throwable $th) {
            return response()->json('error');
        }
    }
}
