<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerChildren extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'age',
        'institution',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $touches = ['customer'];
}
