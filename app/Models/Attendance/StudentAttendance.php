<?php

namespace App\Models\Attendance;

use App\Models\People\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;

        protected $fillable = [
        'attendance_session_id',
        'student_id',
        'status',
        'remark'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
