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
        'photo',
        'address',
        'city',
        'postcode',
        'state_id',
        'birth_place',
        'birth_state',
        'occupation',
        'sector',
        'identification_number_police',
        'salary_range_id',
        'working_hour',
        'updated_by',
        'birth_order',
        'additional_tags',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'customer_tags', 'customer_id', 'tag_id');
    }

    public function customerAnswers()
    {
        return $this->hasMany(CustomerAnswer::class);
    }

    public function customerAdditionalInfos()
    {
        return $this->hasOne(CustomerAdditionalInfo::class);
    }

    public function customerSpouse()
    {
        return $this->hasOne(CustomerSpouse::class);
    }

    public function customerChildrens()
    {
        return $this->hasMany(CustomerChildren::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'customer_p_i_c_s', 'customer_id', 'user_id');
    }
}
