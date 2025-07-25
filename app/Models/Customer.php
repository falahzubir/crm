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
        'number_of_children',
    ];

    public function tags()
    {
        return $this->hasManyThrough(Tag::class, CustomerTag::class, 'customer_id', 'id', 'id', 'tag_id')
                    ->whereNull('customer_tags.deleted_at');
    }

    public function activeCustomerTags()
    {
        return $this->hasMany(CustomerTag::class)->whereNull('deleted_at');
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

    public function receiverAddresses()
    {
        return $this->hasMany(ReceiverAddress::class);
    }
}
