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
        'quantity'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
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
    public function scopeUserDetail($query, $id)
    {
        return $query->where('user_id','=', $id);
    }
}
