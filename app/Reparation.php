<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reparation extends Model
{
    protected $fillable = [
        'vehicule_id',
        'details',
        'frais_reparations'
    ];

    public function vehicule()
     {
        return $this->belongsTo('App\Vehicule');
     }
}
