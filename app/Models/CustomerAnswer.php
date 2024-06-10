<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'customer_id',
        'value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Define the relationship to Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Indicate that the customer model should be touched
    protected $touches = ['customer'];
}
