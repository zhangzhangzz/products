<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table        = "roles";  // 设置要关联的数据表
    protected $primaryKey   = "id"; // 关联的表主键
    public $timestamps      = "false"; // 不在维护 updated_at    created_at 这两个字段
    public function user()
    {
            return $this -> belongsToMany('App\Http\Model\Admin\User');
    }
    public function action()
    {
            return $this -> belongsToMany('App\Http\Model\Admin\Action');
    }
}
