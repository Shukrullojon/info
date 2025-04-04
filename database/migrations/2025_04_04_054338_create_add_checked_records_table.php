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
        Schema::table('records', function (Blueprint $table){
            $table->tinyInteger('checked')->default(1)->comment("Sheetdan malumot olganda, keyin sheetdan o'chirilsa, shu orqali tekshiraman.");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_checked_records');
    }
};
