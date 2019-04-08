<?php

namespace App\Http\Controllers\Admin\After;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class AfterController extends Controller{


    /**
     * 售后
     * 苏鹏
     */
    public function index()
    {
        return view("admin.after.index"); 
    }


}