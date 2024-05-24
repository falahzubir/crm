<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiverAddress extends Model
{
    use HasFactory;

    protected $touches = ['customer'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
