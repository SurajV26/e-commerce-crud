<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'dob',
        'mobile',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class ,'assigned_to');
    }

    // public function roles()
    // {
    //     return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id');
    // }

    public function roles()
    {
        return $this->hasOne(ModelHasRoles::class, 'model_id', 'id' );
    }

    public function modelHasRoles()
    {
        return $this->hasMany(ModelHasRoles::class, 'model_id');
    }

    // public function isAdmin()
    // {  
    //     return $this->roles->role->where('name', 'admin')->isNotEmpty();
    // }
    

}
