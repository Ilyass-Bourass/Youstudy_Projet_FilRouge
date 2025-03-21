<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    protected $fillable=[
        'titre',
        'description',
        'matiere_cour',
        'niveau'
    ];

    public function partieCour(){
        return $this->hasMany(PartieCour::class);
    }
}
