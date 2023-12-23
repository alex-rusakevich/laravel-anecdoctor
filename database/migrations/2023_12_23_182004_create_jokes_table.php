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
        Schema::create('jokes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->default('***');
            $table->text('body');
            $table->string('source')->default('');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jokes');
    }
};
