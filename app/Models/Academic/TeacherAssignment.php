<?php

namespace App\Models\Academic;

use App\Models\People\Teacher;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAssignment extends Model
{
    use HasFactory;
    

     protected $fillable = [
        'teacher_id',
        'batch_id',
        'subject_id',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
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
