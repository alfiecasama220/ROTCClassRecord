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
        Schema::create('batch', function (Blueprint $table) {
            $table->id();
            $table->string('batch_name');
            $table->string('yearFrom');
            $table->string('yearTo');
            $table->integer('maxPrelimValue')->default(200);
            $table->integer('maxMidtermValue')->default(200);
            $table->integer('maxFinalValue')->default(200);
            $table->unsignedBigInteger('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
