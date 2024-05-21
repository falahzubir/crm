<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'tag_id',
    ];

    protected $touches = ['customer'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
