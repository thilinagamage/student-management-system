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
        Schema::create('batch_subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('batch_id')
                  ->constrained('batches')
                  ->cascadeOnDelete();

            $table->foreignId('subjects_id')
                  ->constrained('subjects')
                  ->cascadeOnDelete();

            $table->timestamps();

            $table->unique(['batch_id', 'subjects_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('batch_subjects');
    }

};
