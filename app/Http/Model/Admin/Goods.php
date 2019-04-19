<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table        = "goods";  // 设置要关联的数据表
    protected $primaryKey   = "id"; // 关联的表主键
    protected $fillable = [ 'goodsname', 'price','count','realpay','time','date','name'];
    public $timestamps      = false; // 不在维护 updated_at    created_at 这两个字段
    public function business()
    {
        //关联的模型类名, 关系字段
        return $this->hasOne('App\Http\Model\Admin\Business','good_id');
    }
}
