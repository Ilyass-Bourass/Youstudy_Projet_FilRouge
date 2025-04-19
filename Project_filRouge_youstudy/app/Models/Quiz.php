<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'partie_cour_id',
    ];

    public function partieCour()
    {
        return $this->belongsTo(PartieCour::class);
    }

    public function questions()
    {
        return $this->hasMany(QuestionsQuiz::class);
    }
}
