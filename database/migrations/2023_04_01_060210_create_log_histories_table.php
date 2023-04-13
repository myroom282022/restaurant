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
        Schema::create('log_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->text('tone')->nullable();
            $table->text('keyword')->nullable();
            $table->longText('description')->nullable();
            $table->string('title')->nullable();
            $table->text('hash_tag_name')->nullable();
            $table->string('word_size')->nullable();
            $table->string('device_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_histories');
    }
};
