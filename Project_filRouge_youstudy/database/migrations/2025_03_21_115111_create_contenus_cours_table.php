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
        Schema::create('contenus_cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('partie_cours_id')->constrained('partie_cours')->onDelete('cascade');
            $table->enum('type',['video','textPdf','exercice','quiz']);

            $table->string('url_video')->nullable();
            $table->integer('duree_video')->nullable();

            $table->string('contenu_definition')->nullable();
            $table->string('contenu_propriete')->nullable();
            $table->string('contenu_exemple')->nullable();

            $table->string('contenu_exercice')->nullable();
            $table->string('solution_exercice_video')->nullable();
            $table->text('solution_exercice_text')->nullable();
            $table->enum('difficulte_exercice',['facile','moyen','difficile'])->nullable();

            $table->integer('nombre_question_quiz')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus_cours');
    }
};
