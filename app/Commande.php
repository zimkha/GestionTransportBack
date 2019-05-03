<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    protected $fillable = ['client_id'];
    public function client()
    {
            return $this->belongsTo('App\Client');
    }
}
