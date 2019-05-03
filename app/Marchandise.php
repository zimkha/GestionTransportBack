<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marchandise extends Model
{
     protected $fillable = ['libelle', 'typemarchandise_id'];

     public function typemarchandise()
     {
          return $this->belongsTo('App\Typemarchandise');
     }

     public function receptions()
     {
        return $this->hasMany('App\Reception');
     }
}
