<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Role;
use App\Models\ManageEmployees\Role_has_permission;
use App\Models\ManageEmployees\Screen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function get_roles(){
        return Role::all();
    }

    public function get_modules(){
        return Screen::orderBy("module_id", "asc")->get()->unique('module_id');
    }

    public function get_pages($role_id,$module_id){
        $screens=Screen::where('module_id',$module_id)->orderBy("sort", "asc")->get();
        foreach($screens as $screen){
            $sc=explode(',', $screen->operation_type);
            $arr=[];

            foreach($sc as $one)
                $arr[$one]=false;

            $rol_per=Role_has_permission::where(['role_id'=>$role_id,'screen_route'=>$screen->screen_route])->get();
            if(count($rol_per))
                foreach($rol_per as $rol)
                    $arr[$rol->operation_id]=true;

            $screen->operation_type=$arr;
        }
        return $screens;
    }

    public function store(Request $request){
        $role=$request->role_id;

        foreach($request->pages as $page){
            $route=$page['screen_route'];
            $operations=$page['operation_type'];
            DB::table('role_has_permissions')->where(['screen_route'=>$route,'role_id'=>$role])->delete();

            $ops=array_keys($operations);
            foreach($ops as $op){
                if($operations[$op])
                    Role_has_permission::create(['screen_route'=>$route,'operation_id'=>$op,'role_id'=>$role]);
            }
        }
    }

}
