<?php

namespace App\Models\Attendance;

use App\Models\Academic\Batch;
use App\Models\Academic\Subjects;
use App\Models\People\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'batch_id',
        'subject_id',
        'attendance_date',
        'status',
        'start_time',
        'end_time',
        'remarks',
    ];
    protected $casts = [
    'attendance_date' => 'datetime:Y-m-d',
    ] ;


    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function batch()
    {
             return $this->belongsTo(Batch::class,'batch_id','id' );
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class, 'subject_id');
    }
}
