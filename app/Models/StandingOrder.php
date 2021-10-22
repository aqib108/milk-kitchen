<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StandingOrder extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'product_id',
        'day_id',
        'quantity',
        'region_name'
    ];
    public function scopeUserDetail($query, $id,$name)
    {
    
        return $query->where(['user_id'=> $id,'region_name'=>$name]);
    }
}
