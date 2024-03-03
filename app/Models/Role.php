<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    protected $fillable = [
        'name',
        'guard_name'
    ];  
    
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
}
