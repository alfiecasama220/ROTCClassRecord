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
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade'); // Foreign key to students table
            $table->unsignedBigInteger('batch_id')->constrained()->onDelete('cascade'); // Foreign key to batch table
            $table->integer('A1')->default(null)->nullable(); // Default to 0 if not set
            $table->integer('A2')->default(null)->nullable();
            $table->integer('A3')->default(null)->nullable();
            $table->integer('A4')->default(null)->nullable();
            $table->integer('A5')->default(null)->nullable();
            $table->integer('A6')->default(null)->nullable();
            $table->integer('A7')->default(null)->nullable();
            $table->integer('A8')->default(null)->nullable();
            $table->integer('A9')->default(null)->nullable();
            $table->integer('A10')->default(null)->nullable();
            $table->integer('A11')->default(null)->nullable();
            $table->integer('A12')->default(null)->nullable();
            $table->integer('A13')->default(null)->nullable();
            $table->integer('A14')->default(null)->nullable();
            $table->integer('A15')->default(null)->nullable();
            $table->double('prelim')->nullable();
            $table->double('midterm')->nullable();
            $table->double('final')->nullable();
            $table->double('merit')->nullable();
            $table->double('final_grade')->nullable();
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            // $table->integer('maxPrelimValue')->default(200);
            // $table->integer('maxMidtermValue')->default(200);
            // $table->integer('maxFinalValue')->default(200);
            $table->timestamps();

            // $table->foreign('batch_id')->references('id')->on('batch')->onDelete('cascade'); // Foreign key constraint

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance');
    }
};
