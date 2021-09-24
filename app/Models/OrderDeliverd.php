<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class OrderDeliverd extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_order_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function scopeWeekDetail($query,$arr)
    {
        return $query->whereBetween('created_at',[$arr->created_at->subDays(6)->format('Y-m-d 00:00:00'),$arr->created_at->format('Y-m-d 23:59:59')])->get();
    }
    
    public function scopeUserDetail($query, $id)
    {
        return $query->where('user_id','=', $id);
    }

    public function days(){
        return $this->hasMany(WeekDay::class,'id');

    }
}
