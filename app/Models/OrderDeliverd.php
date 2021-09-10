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

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function scopeWeekDetail($query,$arr)
    {
        // dd($arr-);
        return $query->whereBetween('created_at',[$arr->created_at->subDays(6),$arr->created_at])->get();
    }
    
    public function scopeUserDetail($query, $id)
    {
        return $query->where('user_id','=', $id);
    }
}
