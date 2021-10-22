<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class WeekDay extends Model
{
    use HasFactory;

    public function WeekDay()
    {
        return $this->hasMany(ProductOrder::class,'day_id','id');
    }

    public function WeekDayForStandingOrder()
    {
        return $this->hasMany(StandingOrder::class,'day_id','id');
    }

    public function orderByUserID()
    {
        return $this->WeekDay()->where('user_id','=', Auth::id());
    }

    public function productOrder()
    {
        return $this->hasMany(ProductOrder::class,'day_id','id');
    }
    public function orderDeliverd()
    {
        return $this->hasMany(OrderDeliverd::class,'product_order_id','id');
    }

    
}
