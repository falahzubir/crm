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
        Schema::create('customer_additional_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('hobby', 255)->nullable()->default(null);
            $table->string('fav_color', 100)->nullable()->default(null);
            $table->string('fav_food', 100)->nullable()->default(null);
            $table->string('fav_beverage', 100)->nullable()->default(null);
            $table->string('fav_pet', 100)->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_additional_infos');
    }
};
