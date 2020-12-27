<?php

namespace App\Http\Controllers\API\Finance;

use App\Http\Controllers\Controller;
use App\Models\Finance\Account;
use Kalnoy\Nestedset\NodeTrait;
use Kalnoy\Nestedset\NestedSet;
use Illuminate\Http\Request;
use DB;

class AccountChartController extends Controller
{
    public function index(){
        $accounts = Account::withDepth()
        ->with('ancestors')
        ->get()
        ->toTree();
        return $accounts;
    }

    public function store(Request $request){

        $user=DB::table('users')->pluck('id')->first();
        $dept = new Account;
        $dept->name=$request->name;
        $dept->name_ar=$request->name_ar;
        $dept->account_type=$request->account_type;
        $dept->balance_type=$request->balance_type;
        $dept->final_account=$request->final_account;
        $dept->accountable_type=$request->account_number;
        $dept->user_id=$user;
        if($request->parent_account && $request->parent_account !== 0) {
            $parent_account=Account::find($request->parent_account);
            $parent_account->appendNode($dept);
        }
        $dept->save();
        return response()->json(['success'=>'Setup saved successfully.'],200);
    }

    public function get_full_path(){
        $lang=session('lang');
            if($lang=='ar'){//arabic
                $name_lang='name_ar';
            }else{//english
                $name_lang='name';
            }
        $depts=Account::all();
        $xx=[];
        dd($depts);
        foreach($depts as $dept){
            $str='';
            if($dept->parent_id!=0){
                $ids=explode('-',$dept->parent_id);

                foreach($ids as $index=>$id){
                    $dept1=Account::where(['parent_id'=>$id])->first();
                    if($dept1!=null){
                        if($index==0)
                            $str.=$dept1->$name_lang;
                        else
                            $str.='/ '.$dept1->$name_lang;
                    }
                }
                if($str!='')
                    array_push($xx,[
                        'name'=>$str,
                        'parent_id'=>$dept1->parent_id,
                        'id'=>$dept1->id,
                    ]);
            }else{
                $dept1=Account::where(['parent_id'=>$dept->parent_id])->first();
                if($dept1!=null){
                    $str=$dept1->name;
                    array_push($xx,[
                        'name'=>$str,
                        'parent_id'=>$dept1->parent_id,
                        'id'=>$dept1->id,
                    ]);
                }
            }
        }
        return $xx;
    }

}
