<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\Assign;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'driver_code',
        'status',
        'athority_number',
        'account_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function customerDetail()
    {
        return $this->belongsTo(customerDetail::class, 'id', 'user_id');
    }

    public function warehouseManagers()
    {
        return $this->hasMany(AssignWarehouse::class,'user_id','id');
    }

    public function wareHouses()
    {
        return $this->belongsToMany(Warehouse::class, 'assign_warehouses','warehouse_id','user_id','id');
    }
    public function zones()
    {
        return $this->belongsToMany(Zone::class, 'assign_drivers','driver_id','zone_id','id');
    }
    public function groups()
    {
        return $this->belongsToMany(AssignGroup::class, 'assign_groups','','','','');
    }
}
