<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typemarchandise extends Model
{
      protected $fillable = [
        'libelletype'
      ];

      public function marchandises()
      {
           return $this->hasMany('App\Marchandise');
      }
}
