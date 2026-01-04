<?php

namespace App\Models;

use App\Models\Academic\Batch;
use App\Models\People\Student;
use App\Models\People\Teacher;
use App\Models\People\Admin;
use App\Models\Permission\Permission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'login_email',
        'password',
        'user_type',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];



    public function student()
    {
        return $this->hasOne(Student::class);
    }

    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }


    public function admin()
    {
        return $this->hasOne(Admin::class);
    }


    public function batches()
    {
        return $this->belongsToMany(Batch::class, 'enrollments', 'student_id', 'batch_id')
                    ->withTimestamps();
    }


    public function isAdmin()
    {
        return $this->user_type === 'admin';
    }

    public function isTeacher()
    {
        return $this->user_type === 'teacher';
    }


    public function isStudent()
    {
        return $this->user_type === 'student';
    }

    public function isReceptionist()
    {
        return $this->user_type === 'receptionist';
    }

    public function isSuperAdmin()
    {
        return $this->is_super_admin === true;
    }

    public function canManageAdmins()
    {
        return $this->user_type === 'admin' && $this->is_super_admin;
    }

    public function permissions()
{
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission)
    {
        return $this->permissions->contains('name', $permission);
    }


    public function getProfileImageAttribute()
    {
        if ($this->user_type === 'student' && $this->student) {
            return $this->student->profile_image;
        }

        if ($this->user_type === 'teacher' && $this->teacher) {
            return $this->teacher->profile_image;
        }

        return $this->attributes['profile_image'] ?? 'default-avatar.png';
    }

    public function getDisplayNameAttribute()
    {
        if ($this->isStudent() && $this->student) {
            return $this->student->full_name;
        }

        if ($this->isTeacher() && $this->teacher) {
            return $this->teacher->full_name;
        }

        return $this->username;
    }


}
