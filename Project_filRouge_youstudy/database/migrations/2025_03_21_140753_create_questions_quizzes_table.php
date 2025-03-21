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
        Schema::create('questions_quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_cours_id')->constrained('contenus_cours')->onDelete('cascade');
            $table->text('enonce');
            $table->json('propostions');
            $table->integer('indice_vrai');
            $table->Integer('point')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions_quizzes');
    }
};
