<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $guarded=[''];

    public function regionName()
    {
        return $this->belongsTo(Region::class,'region_id');
    }

    public function deliveryZone()
    {
        return $this->hasMany(DeliverySheduleZone::class,'zone_id','id');
    }


}
