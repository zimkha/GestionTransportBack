<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    protected $fillable = ['commande_id','montant_encaisse', 'remise'];

    public function commande()
    {
    	return $this->belongsTo('App\Commande');
    }
}
