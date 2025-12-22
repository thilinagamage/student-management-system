<?php

namespace App\Models\Academic;

use App\Models\People\Student;
use App\Models\Attendance\TeacherAttendance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'batch_name',
        'batch_code',
        'start_date',
        'end_date',
        'max_students',
        'status',
    ];

    // ✅ ADD THIS
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }



    public function subjects()
    {
        return $this->belongsToMany(
            Subjects::class,
            'batch_subjects',
            'batch_id',
            'subjects_id'
        );
    }
    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class);
    }

    public function teacherAttendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }


    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'batch_student',
            'batch_id',
            'student_id'
        )->withPivot('status');
    }


}
