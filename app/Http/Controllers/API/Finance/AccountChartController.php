<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountChartController extends Controller
{
    public function index(){
        return view('admin.finance.accounts_chart.index');
    }

    public function create(){
        return view('admin.finance.accounts_chart.create');
    }

    public function store(Request $request){
        return redirect()->route('accounts_chart.index');
    }

    // public function edit(){
    //     return view('admin.finance.accounts_chart.edit');
    // }

    // public function update(Request $request){
    //     return redirect()->route('accounts_chart.index');
    // }

    public function show(){
        return view('admin.finance.accounts_chart.show');
    }

}
