<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Action_Roles extends Model
{
    protected $table        = "action_roles";  // 设置要关联的数据表
    protected $primaryKey   = ""; // 关联的表主键
    protected $fillable = ['roles_id','action_id'];
    public $timestamps      = false; // 不在维护 updated_at    created_at 这两个字段
}
