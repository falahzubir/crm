<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nickname',
        'title_id',
        'gender',
        'marital_status_id',
        'age',
        'identification_number',
        'phone',
        'weight',
        'height',
        'blood_type_id',
        'address',
        'city',
        'postcode',
        'state_id',
        'birth_place',
        'occupation',
        'sector',
        'identification_number_police',
        'salary_range_id',
        'working_hour',
        'updated_by',
    ];
}
