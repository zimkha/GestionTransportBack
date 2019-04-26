<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    protected $fillable = [
        'vh_matricule',
        'typevehicule_id',
        'vh_poids',
        'vh_longueur',
        'vh_hauteure',
        'vh_largeur',
        'vh_ptra',
        'vh_ptac',
        'vh_essieu',
        'vh_statut',
        'vh_disponibilite',
        'image'
        
    ];

    public function typevehicule()
    {
        return $this->belongsTo('App\Typevehicule');
    }
}
