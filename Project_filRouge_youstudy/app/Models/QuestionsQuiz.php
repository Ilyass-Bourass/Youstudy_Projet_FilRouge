<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionsQuiz extends Model
{
    protected $fillable=[
        'quiz_cours_id',
        'enonce',
        'propostions',
        'indice_vrai',
        'point'
    ];

    public function contenuCour(){
        return $this->belongsTo(ContenusCour::class);
    }
}
