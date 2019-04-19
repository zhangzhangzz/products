<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $table = "account";
    public $timestamps = false;


    public function user_select($id){

        $account = $this->where("id",$id)->get()->toArray();
        return $account;

    }


}