<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerAnswer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'question_id',
        'customer_id',
        'value',
    ];
}
