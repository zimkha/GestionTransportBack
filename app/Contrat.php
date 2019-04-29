<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
     protected $fillable = [
        'employe_id',
        'typecontrat_id',
        'date_debut_contrat',
        'date_fin_contrat',
        'status',
        'salaire_brute',
        'salaire_net'
     ];

     public function employe()
     {
         return $this->belongsTo('App\Employe');
     }

     public function  typecontrat()
     {
          return $this->belongsTo('App\Typecontrat');
     }
}
