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
            $table->id(); // Primary key
            $table->string('student_number')->unique()->nullable(); // A unique identifier for students, could be the ID
            $table->unsignedBigInteger('batch_id')->nullable(); // Foreign key reference to the batch
            $table->string('first_name');
            $table->string('middle_name')->nullable(); // Middle name is optional
            $table->string('last_name');
            $table->string('course'); // You can adjust this field based on your use case
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');

            $table->foreign('batch_id')->references('id')->on('batch')->onDelete('cascade'); // Foreign key constraint
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
