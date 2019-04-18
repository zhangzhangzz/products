<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Assess extends Model
{
    protected $table        = "assess";  // 设置要关联的数据表
    protected $primaryKey   = "bus_id"; // 关联的表主键
    protected $fillable = ['content','level','date','content_time','reply_time','reply'];
    public $timestamps      = false; // 不在维护 updated_at    created_at 这两个字段
}
