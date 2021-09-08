<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderDeliverd extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'product_order_id',
        'product_id',
        'day_id',
        'quantity',
        'price'
    ];

    public function WeekDay()
    {
        return $this->hasMany(ProductOrder::class,'day_id','id');
    }

    public function orderByUserID()
    {
        return $this->WeekDay()->where('user_id','=', Auth::id());
    }
}
