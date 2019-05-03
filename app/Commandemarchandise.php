<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commandemarchandise extends Model
{
    protected $fillable = [  
            'marchandise_id',
            'commande_id',
            'qte_commander'
    ];

    public function marchandise()
    {
        return $this->belongsTo('App\Marchandise');
    }
    public function commande()
    {
        return $this->belongsTo('App\Commande');
    }
}
