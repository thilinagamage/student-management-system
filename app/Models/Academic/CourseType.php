<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;


    protected $table = 'course_types';


    protected $fillable = [
        'type_name',
        'description',
        'status',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'course_type_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
