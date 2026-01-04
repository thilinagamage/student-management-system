<?php

namespace App\Models\Attendance;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendanceSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_date',
        'course_id',
        'batch_id',
        'marked_by'
    ];

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }


}
