<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel naming convention)
    protected $table = 'course_types';

    // Mass assignable fields
    protected $fillable = [
        'type_name',
        'description',
        'status',
    ];

    /**
     * Relationship: CourseType has many Courses
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'course_type_id', 'id');
    }

    /**
     * Optional: scope for active course types
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
