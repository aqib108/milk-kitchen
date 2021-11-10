<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasualOrder extends Model
{
    use HasFactory;
    protected $fillable =['product_id','quantity','driver_id','customer_id'];
}
