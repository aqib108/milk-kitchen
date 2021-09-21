<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySheduleZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone_id',
        'day_id',
    ];

}
