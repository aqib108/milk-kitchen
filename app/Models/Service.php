<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable =[
        'product_id',
        'group_id',
        'ctn_price',
        'bottle_price',
        'saleable'
    ];

    public function groups()
    {
       return $this->hasOne(GroupCustomer::class,'id','group_id');
    }
}
