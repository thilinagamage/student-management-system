<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'photo',
        'phone',
        'role_level',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
