<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affectation extends Model
{
    protected $fillable = [

        'employe_id',
        'vehicule_id',
        'date_fin_af',
        'statut'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function vehicule ()
    {
        return $this->belongsTo('App\Vehicule');
    }

    public function livraisons()
    {
        return $this->hasMany('App\Livraison');
    }

   
}
