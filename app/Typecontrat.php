<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typecontrat extends Model
{
    protected $fillable = [
        'nom_contrat',
        'duree_max_en_mois',
        'duree_min_en_mois'
    ];

    public function contrats()
    {
         return $this->hasMany('App\Contrat');
    }

}
