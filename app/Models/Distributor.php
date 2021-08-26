<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'city_id',
        'region_id',
        'country_id',
        'status',
    ];
    public $timestamps=true;
}
