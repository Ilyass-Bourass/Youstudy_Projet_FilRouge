<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartieCour extends Model
{
    protected $fillable=[
       'cour_id',
        'titre',
        'order',
        'contenu_definition',
        'contenu_propriete',
        'contenu_exemple',
        'url_video',
        'contenu_exercice',
        'solution_exercice_video',
        'solution_exercice_text',
        'difficulte_exercice',
    ];

    public function cour(){
        return $this->belongsTo(Cour::class);
    }
    public function quiz(){
        return $this->hasOne(Quiz::class);
    }
    
}
