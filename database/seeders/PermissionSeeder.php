<?php

namespace Database\Seeders;

use App\Models\Permission\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::insert([
        ['name'=>'manage_admins','label'=>'Manage Admins'],
        ['name'=>'manage_students','label'=>'Manage Students'],
        ['name'=>'manage_teachers','label'=>'Manage Teachers'],
        ['name'=>'manage_batches','label'=>'Manage Batches'],
        ['name'=>'manage_attendance','label'=>'Manage Attendance'],
        ['name'=>'view_reports','label'=>'View Reports'],
        ['name'=>'export_reports','label'=>'Export Reports'],
        ]);

    }
}
