<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartieCour extends Model
{
    protected $fillable=[
        'titre',
        'order',
        'cour_id'
    ];

    public function cour(){
        return $this->belongsTo(Cour::class);
    }

    public function contenuCour(){
        return $this->hasMany(ContenusCour::class);
    }
}
