<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'hobby',
        'fav_color',
        'fav_pet',
        'fav_food',
        'fav_beverage',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    protected $touches = ['customer'];
}
