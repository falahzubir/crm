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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 125)->notNull();
            $table->string('nickname', 125)->nullable()->default(null);
            $table->string('title', 50)->nullable()->default(null);
            $table->string('gender', 10)->notNull();
            $table->integer('age')->unsigned()->nullable()->default(null);
            $table->string('blood_type', 50)->nullable()->default(null);
            $table->string('photo', 255)->nullable()->default(null);
            $table->string('marital_status', 50)->nullable()->default(null);
            $table->string('phone', 50)->nullable()->default(null);
            $table->integer('siblings')->unsigned()->nullable()->default(null);
            $table->integer('birth_order')->unsigned()->nullable()->default(null);
            $table->string('birth_place', 50)->nullable()->default(null);
            $table->float('weight')->nullable()->default(null);
            $table->float('height')->nullable()->default(null);
            $table->string('address', 255)->nullable()->default(null);
            $table->string('postcode', 10)->nullable()->default(null);
            $table->string('city', 50)->nullable()->default(null);
            $table->unsignedBigInteger('state_id')->nullable()->default(null);
            $table->string('occupation', 50)->nullable()->default(null);
            $table->string('sector', 10)->nullable()->default(null);
            $table->string('identification_number', 50)->nullable()->default(null);
            $table->string('Identification_number_police', 50)->nullable()->default(null);
            $table->integer('salary_range')->unsigned()->nullable()->default(null);
            $table->string('working_hour', 10)->nullable()->default(null);
            $table->text('additional_tags')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
