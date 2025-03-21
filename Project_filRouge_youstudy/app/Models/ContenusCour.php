<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContenusCour extends Model
{
    protected $fillable=[
        'partie_cours_id',
        'type',
        'url_video',
        'duree_video',
        'contenu_pdf',
        'contenu_exercice',
        'solution_exercice',
        'difficulte_exercice',
        'nombre_question_quiz'
    ];

    public function questions(){
        if($this->type!=='quiz'){
            return null;
        }
        return $this->hasMany(QuestionsQuiz::class);
    }

    public function partieCour(){
        return $this->belongsTo(PartieCour::class);
    }

    public function isText(){
        return $this->type==='textPdf';
    }

    public function isVideo(){
        return $this->type==='video';
    }

    public function isExercice(){
        return $this->type==='exercice';
    }

    public function isQuiz(){
        return $this->type==='quiz';
    }

}
