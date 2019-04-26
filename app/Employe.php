<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $fillable = [
        'ep_nomcomplet',
        'ep_nci',
        'ep_adresse',
        'ep_situation_m',
        'ep_nb_enfants',
        'ep_poste',
       
        ];

        public function contrats()
        { 
            return $this->hasMany('App\Contrat');
        }
}
