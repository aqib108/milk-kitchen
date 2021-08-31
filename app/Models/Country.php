<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name','sort_name','phone_code','status'];

    public function states()
    {
        return $this->hasMany(State::class,'country_id','id');
    }
}
