<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionsQuiz extends Model
{
    protected $fillable=[
        'quiz_id',
        'question',
        'propositions',
        'indice_vrai',
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }
}
