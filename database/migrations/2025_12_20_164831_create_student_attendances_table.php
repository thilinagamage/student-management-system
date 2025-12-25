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
        Schema::create('student_attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained()->nullOnDelete();

            $table->date('attendance_date');

            $table->enum('status', ['present', 'absent', 'late', 'excused', 'cancelled']);

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->unique([
                'student_id',
                'batch_id',
                'subject_id',
                'attendance_date'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_attendances');
    }
};
