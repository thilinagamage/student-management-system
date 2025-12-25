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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            //Relationship to users table
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //Basic details
            $table->string('student_id')->unique()->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable();
            $table->integer('age')->nullable();
            $table->string('nic_number')->unique()->nullable();

            //Conrtact details
            $table->integer('phone_number')->nullable();
            $table->integer('whatsapp_number')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('address')->nullable();

            //Academic details
            $table->enum('course', ['cs', 'design'])->nullable();
            $table->enum('batch',['cs', 'design'])->nullable();
            $table->date('enrollment_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'graduated'])->default('active');

            //Parent/Guardian details
            $table->string('parent_guardian_name')->nullable();
            $table->enum('relationship', ['father', 'mother', 'guardian'])->nullable();
            $table->integer('parent_phone')->nullable();
            $table->string('parent_email')->nullable();
            $table->string('parent_address')->nullable();

            //System account details
            $table->string('username')->unique();
            $table->string('login_email')->unique();
            $table->string('password');

            // Profile Image
            $table->string('profile_image')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
