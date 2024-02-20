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
        Schema::create('quardinates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name');
            $table->text('quardinates');
            $table->string('email');
            $table->string('contact');
            $table->string('address');
            $table->string('owneradress');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quardinates');
    }
};
