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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("group_id");
            $table->unsignedBigInteger("subject_id");
            $table->unsignedBigInteger("teacher_id")->nullable();
            $table->json("assignments")->nullable();
            $table->json("attendances")->nullable();
            $table->float("total_current_grade")->nullable();
            $table->float("total_full_grade")->nullable();
            $table->float("total_lessons")->nullable();
            $table->float("presents")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
