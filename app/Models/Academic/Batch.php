<?php

namespace App\Models\Academic;

use App\Models\Attendance\TeacherAttendance;
use App\Models\People\Student;
use App\Models\People\Teacher;
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


    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(  Subjects::class, 'batch_subjects', 'batch_id', 'subject_id' );
    }

    public function teacherAssignments()
    {
        return $this->hasMany(TeacherAssignment::class);
    }

    public function teacherAttendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function batches()
    {
        return $this->belongsToMany(Batch::class,'batch_student' );
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'batch_teacher', 'teacher_assignments', 'batch_id', 'teacher_id')
            ->withPivot('subject_id', 'status');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'batch_id', 'student_id')
            ->withPivot('status')->withTimestamps();
    }
}
