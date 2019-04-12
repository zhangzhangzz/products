<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table        = "business";  // 设置要关联的数据表
    protected $primaryKey   = "id"; // 关联的表主键
    protected $fillable = ['orderid','goodsname','price','count','realpay','time','date','status','ems','name','phone','address'];
    public $timestamps      = false; // 不在维护 updated_at    created_at 这两个字段
}
