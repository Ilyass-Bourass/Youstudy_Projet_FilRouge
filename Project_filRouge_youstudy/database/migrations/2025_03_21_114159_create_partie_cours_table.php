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
        Schema::create('partie_cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cour_id')->constrained('cours')->onDelete('cascade'); 
            // Infos de base
            $table->string('titre');
            $table->integer('order')->default(1);
    
            // Contenu théorique
            $table->longText('contenu_definition')->nullable();
            $table->longText('contenu_propriete')->nullable();
            $table->longText('contenu_exemple')->nullable();
    
            // Vidéo du cours
            $table->string('url_video')->nullable();
    
            // Exercice
            $table->longText('contenu_exercice')->nullable();
            $table->string('solution_exercice_video')->nullable();
            $table->longText('solution_exercice_text')->nullable();
            $table->enum('difficulte_exercice', ['facile', 'moyen', 'difficile'])->nullable();
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partie_cours');
    }
};
