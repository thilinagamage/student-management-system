<?php

namespace App\Models\People;

use App\Models\Academic\Batch;
use App\Models\Attendance\StudentAttendance;
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
    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

      // 🔹 Relationship: Each student belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }


    public function batches()
    {
        return $this->belongsToMany(
            Batch::class,
            'batch_student',
            'student_id',
            'batch_id'
        )->withPivot('status');
    }



}
