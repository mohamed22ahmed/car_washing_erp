<?php

namespace App\Http\Controllers\API\permission;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Employee;
use App\Models\ManageEmployees\Role_has_permission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index(){
        $emp=Employee::where('id',session('user')->id)->first();
        if($emp){
            $role_id=$emp->role;
            return Role_has_permission::where('role_id',$role_id)->get();
        }
    }
}
