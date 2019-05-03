<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    protected $fillable = ['affectation_id','reception_id','user_id','qte_livre',];

    public function affectation()
    {
        return $this->belongsTo('App\Affectation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function reception()
    {
        return $this->belongsTo('App\Reception');
    }
}
