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
            $table->string('name',50)->nullable();
            $table->string('surname',50)->nullable();
            $table->string('given_name',70)->nullable();
            $table->date('jdu_id',20)->nullable();
            $table->date('phone',20)->nullable();
            $table->date('parent_phone',20)->nullable();
            $table->tinyInteger("is_sms")->default(1)->comment("0 -> can not send sms, 1 -> can send sms");
            $table->tinyInteger("is_send")->default(1)->comment("0 -> need to send sms, 1 -> already send sms");
            $table->integer("total_score")->default(0);
            $table->integer("total_attendance")->default(0);
            $table->tinyInteger("status")->default(1);
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
