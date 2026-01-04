<?php

namespace App\Models\Academic;

use App\Models\People\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model

{
    protected $fillable = [
        'student_id',
        'course_id',
        'batch_id', 'status',
        'enrollment_date' =>'date'
    ];

   public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }


    public function isPending() {
        return $this->status === 'pending';
    }
}


