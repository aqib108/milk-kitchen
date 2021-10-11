<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image_url',
        'status',
        'description',
        'sku',
        'new',
        'pack_size',
        'active',
        'f_ctn_price',
        'f_bottle_price',
        'f_saleable',
        'r_ctn_price',
        'r_bottle_price',
        'r_saleable',
        'c_ctn_price',
        'c_bottle_price',
        'c_saleable',
    ];

    public function product()
    {
       return $this->hasMany(OrderDeliverd::class,'product_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class,'product_id','id');
    }

    public function orderByUserID()
    {
        return $this->product()->where('user_id','=', Auth::id());
    }

    public function orderDelivered()
    {
        return $this->hasMany(OrderDeliverd::class,'product_id','id');
    }

    public function productOrder()
    {
        return $this->hasMany(ProductOrder::class,'day_id','id');
    }
    
    public function orders()
    {
        return $this->hasMany(ProductOrder::class,'product_id','id');
    }

}
