<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'name',
        'status'
    ];
    public function getzone()
    {
        return $this->hasManyThrough(Zone::class, Region::class);
    }
}
