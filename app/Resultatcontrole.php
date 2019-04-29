<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultatcontrole extends Model
{
    protected $fillable = [
        'rs_name',
        'description'
    ];

    public function controletechniques()
    {
             return $this->hasMany('App\Controletechnique');
    }
}
