<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'customer_tags', 'tag_id', 'customer_id');
    }
}
