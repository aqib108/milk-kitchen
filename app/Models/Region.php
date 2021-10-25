<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'warehouse_id',
    ];

    public function wareHouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    public function zone() {
        return $this->hasOne(Zone::class);
    }
}
