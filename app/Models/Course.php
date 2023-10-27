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
        'start_date',
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class, 'clients_courses')->whitPivot('mount');
    }

    public function detailRegisters()
    {
        return $this->hasMany(DetailRegister::class);
    }
}
