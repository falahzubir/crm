<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    use HasFactory;

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return $this->belongsTo(Permission::class);
    }
}
