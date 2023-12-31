<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRegister extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'client_id',
        'course_id',
        'method_payment',
        'business_name',
        'nit',
        'mount',
        'mount_initial',
        'discount',
        'discounted_price',
        'type_payment',
        'type_payment_initial',
        'save_mount_in_words'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function registrationes()
    {
        return $this->hasMany(Registration::class, 'detail_register_id', 'id');
    }
}

