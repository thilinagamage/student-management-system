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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('username')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->string('nic_number')->unique();

            $table->string('teacher_code')->unique(); // TCH2025-001

            $table->string('nic')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('email')->nullable();

            $table->string('address')->nullable();

            $table->date('joined_date')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('login_email')->nullable();
            $table->string('password')->nullable();

            $table->string('profile_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
