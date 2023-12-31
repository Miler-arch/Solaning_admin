<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'mount_update',
        'date_update',
        'mount_inicial',
        'date_start',
        'client_id',
        'detail_register_id',
        'file_path',
        'updated_type_payment',
        'type_payment_inicial'
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

    public function detailRegisters(){
        return $this->hasMany(DetailRegister::class);
    }
}
