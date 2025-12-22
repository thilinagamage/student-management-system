<?php

namespace App\Models\Attendance;

use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use App\Models\People\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $fillable = [
        'student_id',
        'batch_id',
        'subject_id',
        'attendance_date',
        'status',
        'start_time',
        'end_time',
        'remarks',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }
}
