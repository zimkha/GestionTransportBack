<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    protected $fillable = [
        'employe_id',
        'typeconge_id',
        'date_debut_conge',
        'date_fin_conge',
        'payable',
        'cg_motifconge'
    ];

    public function employe()
    {
        return $this->belongsTo('App\Employe');
    }

    public function typeconge()
    {
        return $this->belongsTo('App\Typeconge');
    }
}
