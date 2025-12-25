<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_attendances', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('teacher_id')
                  ->constrained('teachers')
                  ->cascadeOnDelete();

            $table->foreignId('batch_id')
                  ->constrained('batches')
                  ->cascadeOnDelete();

            $table->foreignId('subject_id')
                  ->constrained('subjects')
                  ->cascadeOnDelete();

            // Attendance info
            $table->date('attendance_date');

            $table->enum('status', [
                'present',
                'absent',
                'late',
                'cancelled'
            ])->default('present');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();

            // ❗ Prevent duplicate attendance
            $table->unique(
                ['teacher_id', 'batch_id', 'subject_id', 'attendance_date'],
                'unique_teacher_attendance'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_attendances');
    }
};
