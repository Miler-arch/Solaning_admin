<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'method_payment',
        'business_name',
        'concept',
        'nit',
        'mount',
        'start_date',
        'client_id',
        'course_id',
        'user_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
