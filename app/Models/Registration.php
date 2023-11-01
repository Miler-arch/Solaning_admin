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
        'client_id',
        'detail_register_id'
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

    public function detailRegister()
    {
        return $this->hasOne(DetailRegister::class, 'id');
    }
}
