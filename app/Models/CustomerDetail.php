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
    'business_country_id',
    'business_city_id',
    'business_region_id',
    'business_phone_no',
    'business_email',
    'business_contact_no',
    'user_id',
    'delivery_name',
    'delivery_address_1',
    'delivery_address_2',
    'delivery_country_id',
    'delivery_city_id',
    'delivery_region_id',
    'delivery_notes',
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }


}
