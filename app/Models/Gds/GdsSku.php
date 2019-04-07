<?php
/**
 * Created by PhpStorm.
 * User: 89340
 * Date: 2019/4/7
 * Time: 11:00
 */

namespace App\Models\Gds;

use App\Models\Model;

class GdsSku extends Model
{
    protected $appends = ['pay_name'];

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = $value*100;
    }

    public function getPriceAttribute($value)
    {
        return $value/100;
    }

    public function getPayNameAttribute()
    {
        return $this->pay == 1 ? '免费' : ($this->pay == 2 ? '微信支付' :'积分支付');
    }
}