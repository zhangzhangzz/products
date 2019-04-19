<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table        = "action";  // 设置要关联的数据表
    protected $primaryKey   = "id"; // 关联的表主键
    protected $fillable = ['name','url','boss','state','sort','path','a'];
    public $timestamps      = false; // 不在维护 updated_at    created_at 这两个字段
    public function roles()
    {
        return $this -> belongsToMany('App\Http\Model\Admin\Roles');
    }
}
