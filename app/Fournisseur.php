<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $fillable = ['nom_fournisseur','adresse','telephone','typefournisseur_id'];


    public function typefournisseur()
    {
         return $this->belongsTo('Typefournisseur');
    }
    public function receptions()
    {
       return $this->hasMany('App\Reception');
    }
}
