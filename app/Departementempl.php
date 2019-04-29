<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departementempl extends Model
{
    protected $fillable = [

        'employe_id',
        'departement_id'
    ];

    public function employe()
    {
         return $this->belongsTo('App\Employe'); 
    }

    public function departement()
    { return $this->belongsTo('App\Departement');}
}
