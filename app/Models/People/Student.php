<?php

namespace App\Models\People;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'dob',
        'age',
        'nic_number',
        'phone_number',
        'whatsapp_number',
        'email',
        'address',
        'course',
        'batch',
        'enrollment_date',
        'status',
        'parent_guardian_name',
        'relationship',
        'parent_phone',
        'parent_email',
        'parent_address',
        'username',
        'login_email',
        'password',
        'profile_image'
    ];
}
