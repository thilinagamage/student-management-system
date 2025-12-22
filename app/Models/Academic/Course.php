<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_code',
        'course_type_id',
        'duration',
        'duration_type',
        'course_fee',
        'description',
        'status',
    ];

    /**
     * Course belongs to a Course Type
     */
    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }
    
        public function subjects()
    {
        return $this->hasMany(Subjects::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

}
