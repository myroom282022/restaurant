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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('translation_id')->nullable();
            $table->boolean('amount')->nullable();
            $table->string('card_number')->nullable();
            $table->string('currency')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('brand')->nullable();
            $table->string('receipt_url')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
