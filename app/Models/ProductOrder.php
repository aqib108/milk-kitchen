<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $table = 'product_orders';
    protected $fillable =[
        'user_id',
        'product_id',
        'day_id',
        'quantity',
        'region_name',
        'zone_name',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function day()
    {
        return $this->belongsTo(WeekDay::class);
    }

    public function customerDetail()
    {
        return $this->belongsTo(customerDetail::class, 'user_id', 'user_id');
    }
    public function scopeUserDetail($query,$productId,$name)
    {
        return $query->where(['product_id'=> $productId,'region_name'=>$name]);
    }
    public function scopeUserDetail1($query,$id,$name)
    {
        return $query->where('user_id',$id)->where('region_name',$name);
    }
    public function scopeDeleteOld($query)
    {
        return $query->delete();
    }
    public function scopeUserProduct($query,$id,$userId)
    {
        return $query->where(['product_id'=>$id,'user_id'=>$userId]);
    }

    public function orderDeliverd()
    {
        return $this->hasMany(OrderDeliverd::class,'product_order_id','id');
    }

    // public function scopeWeekDetail($query,$arr)
    // {
    //     return $query->whereBetween('product_orders.created_at',[$arr->created_at->subDays(6)->format('Y-m-d 00:00:00'),$arr->created_at->format('Y-m-d 23:59:59')])
    //     ->leftJoin('order_deliverds','product_orders.id', '=', 'order_deliverds.product_order_id')->select('product_orders.*', 'order_deliverds.quantity as d_qnty')->get();
    // }
    public function scopeWeekDetail($query,$start,$end)
    {
        return $query->whereDate('updated_at','>=',$start)->whereDate('updated_at','<=',$end)->get();
    }
    
}
