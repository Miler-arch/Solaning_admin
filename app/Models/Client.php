<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'birthdate',
        'city',
        'training',
        'age',
        'ci',
        'email',
        'phone',
        'reference_phone',
    ];

    public function detailRegisters()
    {
        return $this->hasMany(DetailRegister::class);
    }
}
