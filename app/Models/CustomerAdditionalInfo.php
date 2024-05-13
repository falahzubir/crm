<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'hobby',
        'fav_color',
        'fav_pet',
        'fav_food',
        'fav_beverage',
    ];
}
