<?php

namespace App\Http\Controllers\API\Employee;

use App\Http\Controllers\Controller;
use App\Models\ManageEmployees\Employee;
use App\Models\ManageEmployees\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return Role::paginate(5);
    }

    public function store(Request $request){
        Role::create($request->all());
    }

    public function update(Request $request,$id){
        Role::find($id)->update($request->all());
    }

    public function destroy($id){
        if(Employee::where('role',$id)->count()>0)
            return false;
        Role::find($id)->delete();
    }
}
