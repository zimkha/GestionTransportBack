<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['typepaiement_id', 'user_id', 'employe_id', 'status', 'montant_payer'];
    public function typepaiement()
    {
         return $this->belongsTo('App\Typepaiment');

    }

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
