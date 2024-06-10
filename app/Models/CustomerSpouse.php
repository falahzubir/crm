<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerSpouse extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'name',
        'age',
        'occupation',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $touches = ['customer'];
}
