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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Course Basic Info
            $table->string('course_name');
            $table->string('course_code')->unique();

            // Relationship
            $table->foreignId('course_type_id')
                  ->constrained('course_types')
                  ->onDelete('cascade');

            // Course Details
            $table->integer('duration')->nullable();
            $table->string('duration_type')->nullable();
            // months / weeks / years

            $table->decimal('course_fee', 10, 2)->nullable();

            $table->text('description')->nullable();

            // Status
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
