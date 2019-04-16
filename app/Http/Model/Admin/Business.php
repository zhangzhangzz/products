<?php

namespace App\Http\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table        = "business";  // 设置要关联的数据表
    protected $primaryKey   = "id"; // 关联的表主键
    protected $fillable = [
        // 商品ID
        'good_id',
        // 订单状态
        'status',
        // 物流单号
        'ems',
        // 快递公司
        'emsName',
        // 用户ID
        'user_id',
        // 订单编号
        'orderid',
        // 收货人手机号
        'phone',
        // 收货人地址
        'address',
        // 时间戳
        'time',
        // 日期
        'date'
    ];
    public $timestamps      = false; // 不在维护 updated_at    created_at 这两个字段
}
