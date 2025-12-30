<?php

namespace App\Models\Academic;

use App\Models\Attendance\TeacherAttendance;
use App\Models\Academic\Batch;
use App\Models\Academic\Course;
use App\Models\Academic\TeacherAssignment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $fillable = [
        'course_id',
        'subject_name',
        'subject_code',
        'description',
        'status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batches()
    {
        return $this->belongsToMany(
            Batch::class,
            'batch_subjects',
            'subjects_id',
            'batch_id'
        )->withTimestamps();
    }
    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class);
    }

    public function teacherAttendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

}
