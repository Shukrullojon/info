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
        // posts table migration
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // videos table migration
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        // comments table migration
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment');
            $table->morphs('commentable');  // Polymorphic relationship
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
