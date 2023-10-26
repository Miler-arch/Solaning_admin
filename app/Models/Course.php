<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'version',
        'category',
        'price',
        'discount',
        'expire_date',
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'clients_courses')->whitPivot('mount');
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
