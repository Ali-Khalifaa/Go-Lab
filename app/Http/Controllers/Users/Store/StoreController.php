<?php

namespace App\Http\Controllers\Users\Store;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:store');
    }

    public function index()
    {
        $store=Store::find(1);

//        $role = Role::create(['name' => 'admin']);
//        $permission = Permission::create(['name' => 'create resturants']);
//        $permission->assignRole($role);
//        $role->givePermissionTo($permission);
//        $admin->assignRole('admin');

        return view('store');
    }
}
