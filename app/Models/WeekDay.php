<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeekDay extends Model
{
    use HasFactory;

    public function WeekDay()
    {
        return $this->hasMany(ProductOrder::class,'day_id');
    }

    public function orderByUserID()
    {
        return $this->WeekDay()->where('user_id','=', 2);
    }
}