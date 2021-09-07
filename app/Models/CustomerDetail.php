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

  public function bcountry()
  {
      return $this->belongsTo(Country::class,'business_country_id', 'id');
  }
  public function bstate()
  {
      return $this->belongsTo(State::class,'business_region_id', 'id');
  }
  public function bcity()
  {
      return $this->belongsTo(City::class,'business_city_id', 'id');
  }

  public function dcountry()
  {
      return $this->belongsTo(Country::class,'delivery_country_id', 'id');
  }
  public function dstate()
  {
      return $this->belongsTo(State::class,'delivery_region_id', 'id');
  }
  public function dcity()
  {
      return $this->belongsTo(City::class,'delivery_city_id', 'id');
  }

  public function user()
  {
    return $this->belongsTo(User::class,'user_id', 'id');
  }
}
