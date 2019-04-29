<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Controletechnique extends Model
{
    protected $fillable= [
        'vehicule_id',
        'date_controle',
        'numero_pv',
        'defaillance',
        'resultatcontrole_id'
    ];

    public function resultat()
    {
        return $this->belongsTo('App\Resultatcontrole');
    }

    public function vehicule()
    { 
        return $this->belongsTo('App\Vehicule');
    }
}
