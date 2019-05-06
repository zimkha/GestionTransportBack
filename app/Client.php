<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'nomcomplet',
        'adresse',
        'telephone',
        'email',
        'type-client'
    ];
    public function commandes()
    {
        return $this->hasMany('App\Commande');
    }
}
