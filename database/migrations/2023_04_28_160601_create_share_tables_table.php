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
        Schema::create('share_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('share_with_other')->nullable();
            $table->string('club_name')->nullable();
            $table->string('performer')->nullable();
            $table->string('share_table_image')->nullable();
            $table->string('share_table_date')->nullable();
            $table->string('drink_preferences')->nullable();
            $table->string('desired_company')->nullable();
            $table->string('currency')->nullable();
            $table->string('age_limite')->nullable();
            $table->string('additional_info')->nullable();
            $table->string('covide19_check_pvr_test')->nullable();
            $table->string('covide19_check_vaccination_prof')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('share_tables');
    }
};
