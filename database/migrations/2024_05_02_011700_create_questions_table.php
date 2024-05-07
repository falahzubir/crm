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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->notNull();
            $table->string('slug', 255)->notNull();
            $table->string('type', 50)->notNull()->comment('feedback, survey, quiz');
            $table->string('input_type', 50)->notNull();
            $table->boolean('is_predefined')->notNull()->default(false);
            $table->integer('order')->notNull();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
