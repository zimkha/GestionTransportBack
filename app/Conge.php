<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    protected $fillable = [
        'contrat_id',
        'typeconge_id',
        'date_debut_conge',
        'date_fin_conge',
        'payable',
        'cg_motifconge'
    ];

    public function contrat()
    {
        return $this->belongsTo('App\Contrat');
    }

    public function typeconge()
    {
        return $this->belongsTo('App\Typeconge');
    }
}
