<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
  use HasFactory;
  
  protected $fillable =[
    'business_name',
    'business_address_1',
    'business_address_2',
    'business_country',
    'business_city',
    'business_region',
    'business_phone_no',
    'business_email',
    'business_contact_no',
    'user_id',
    'delivery_name',
    'delivery_address_1',
    'delivery_address_2',
    'delivery_country',
    'delivery_city',
    'delivery_zone',
    'delivery_region',
    'delivery_notes',
  ];

  public function user()
  {
    return $this->belongsTo(User::class,'user_id', 'id');
  }
}
