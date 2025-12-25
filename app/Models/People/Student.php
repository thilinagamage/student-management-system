<?php

namespace App\Models\People;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
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


      // 🔹 Relationship: Each student belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
