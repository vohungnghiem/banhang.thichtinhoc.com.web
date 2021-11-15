<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
class RoleController extends Controller
{
    public function get_role_permission() {
        $id = ( isset($_GET['role']) != null ) ? $_GET['role'] : 1;
        # roles
        $role = DB::table('roles')
            ->when($id, function ($query,$id) {
                    $query->where('roles.id','=',$id);
            })
            ->first();
        $roles = DB::table('roles')->get();
        # permissions
        $permission_checked = DB::table('role_has_permissions')->where('role_id',$id)->pluck("permission_id")->toArray();
		$arrchecked = implode(",",$permission_checked);
        $permissions = DB::table('permissions')
            ->leftJoin('role_has_permissions','role_has_permissions.permission_id','permissions.id')
            ->select(
                'permissions.*',
                DB::raw(' (CASE
				WHEN FIND_IN_SET(role_has_permissions.permission_id, "'.$arrchecked.'") THEN "1"
				ELSE "0"
				END) AS role')
            )
            ->get()
            ->unique('id')->chunk(5);
        return view('admincp.roles.role_permission', ['roles'=>$roles,'role'=>$role,'permissions'=>$permissions]);
    }
    public function post_role_permission(Request $request) {
        // dd($request->role);
        $role_id = $request->role;
        DB::table('role_has_permissions')->where('role_id',$role_id)->delete();
        if ($request->check) {
            foreach ($request->check as $key => $value) {
                DB::table('role_has_permissions')->insert([
                    'permission_id' => $key,
                    'role_id' => $role_id
                ]);
            }
        }
        return redirect()->back()->with('success','Đã thành công!');
    }

    public function get_model() {
        $id = ( isset($_GET['user']) != null ) ? $_GET['user'] : 1;
        $users = DB::table('users')->get();
        # user
        $user = DB::table('users')
            ->when($id, function ($query,$id) { $query->where('users.id','=',$id); })
            ->first();
        # roles
        $role_checked = DB::table('model_has_roles')->where('model_id',$id)->pluck("role_id")->toArray();
		$arrchecked = implode(",",$role_checked);
        $roles = DB::table('roles')
            ->leftJoin('model_has_roles','model_has_roles.role_id','roles.id')
            ->select(
                'roles.*',
                DB::raw(' (CASE
				WHEN FIND_IN_SET(model_has_roles.role_id, "'.$arrchecked.'") THEN "1"
				ELSE "0"
				END) AS role')
            )
            ->get()
            ->unique('id')->chunk(5);
         # permissions
         $permission_checked = DB::table('model_has_permissions')->where('model_id',$id)->pluck("permission_id")->toArray();
         $arrchecked = implode(",",$permission_checked);
         $permissions = DB::table('permissions')
             ->leftJoin('model_has_permissions','model_has_permissions.permission_id','permissions.id')
             ->select(
                 'permissions.*',
                 DB::raw(' (CASE
                 WHEN FIND_IN_SET(model_has_permissions.permission_id, "'.$arrchecked.'") THEN "1"
                 ELSE "0"
                 END) AS role')
             )
             ->get()
             ->unique('id')->chunk(5);
        return view('admincp.roles.model', [
            'users'=>$users,
            'user'=>$user,
            'roles'=>$roles,
            'permissions'=>$permissions
        ]);
    }
    public function post_model(Request $request) {
        $model_id = $request->user;
        #role
        DB::table('model_has_roles')->where('model_id',$model_id)->delete();
        if ($model_id == 1) {
            DB::table('model_has_roles')->insertOrIgnore([
                'role_id' => 1,
                'model_type' => 'App\Models\User',
                'model_id' => 1
            ]);
        }
        if ($request->check) {
            foreach ($request->check as $key => $value) {
                DB::table('model_has_roles')->insertOrIgnore([
                    'role_id' => $key,
                    'model_type' => 'App\Models\User',
                    'model_id' => $model_id
                ]);
            }
        }

        #permission
        DB::table('model_has_permissions')->where('model_id',$model_id)->delete();
        if ($request->checka) {
            foreach ($request->checka as $key => $value) {
                DB::table('model_has_permissions')->insertOrIgnore([
                    'permission_id' => $key,
                    'model_type' => 'App\Models\User',
                    'model_id' => $model_id
                ]);
            }
        }
        return redirect()->back()->with('success','Đã thành công!');
    }
    public function generate() {
        Role::create(['name' => 'super-admin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'other']);

        Permission::create(['name' => 'list-super']);
        Permission::create(['name' => 'add-super']);
        Permission::create(['name' => 'edit-super']);
        Permission::create(['name' => 'delete-super']);
        Permission::create(['name' => 'password']);
        Permission::create(['name' => 'list-editor']);
        Permission::create(['name' => 'add-editor']);
        Permission::create(['name' => 'edit-editor']);
        Permission::create(['name' => 'delete-editor']);
        Permission::create(['name' => 'list-other']);
        Permission::create(['name' => 'add-other']);
        Permission::create(['name' => 'edit-other']);
        Permission::create(['name' => 'delete-other']);
        $user = User::find(1);
        $user->givePermissionTo('list-super','add-super','edit-super','delete-super','password'); // giao quyền edit articles cho một user nào đó
        $user->assignRole('super-admin');
    }
}
