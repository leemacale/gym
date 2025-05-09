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
        Schema::create('user_profs', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('age');
            $table->string('gender');
            $table->string('weight');
            $table->string('height');
            $table->string('activity');
            $table->string('goal');
            $table->string('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profs');
    }
};
