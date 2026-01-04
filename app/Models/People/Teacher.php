<?php

namespace App\Models\People;

use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use App\Models\Academic\TeacherAssignment;
use App\Models\Attendance\TeacherAttendance;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

  protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'dob',
        'nic_number',
        'teacher_code',
        'nic_number',
        'phone',
        'whatsapp_number',
        'email',
        'address',
        'joined_date',
        'status',
        'username',
        'login_email',
        'password',
        'profile_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function assignments()
    {
        return $this->hasMany(TeacherAssignment::class,'teacher_id');
    }
    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class);
    }
    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }
    public function batches()
    {
        return $this->belongsToMany( Batch::class,'teacher_assignments','teacher_id','batch_id')
        ->withPivot('subject_id', 'status')->withTimestamps()->distinct();
    }

    public function subjects()
    {
        return $this->belongsToMany(Subjects::class,'teacher_assignments','teacher_id','subject_id' )
        ->withPivot('batch_id', 'status')->distinct();
    }

}
