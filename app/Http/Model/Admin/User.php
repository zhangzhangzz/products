<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table        = "user";  // 设置要关联的数据表
    protected $primaryKey   = "id"; // 关联的表主键
    public $timestamps      = "false" // 不在维护 updated_at    created_at 这两个字段

    public function roles()
    {
        return $this -> belogsToMany('App\Http\Model\Roles')
    }
}
