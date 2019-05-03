<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Reception extends Model
{
    protected $fillable = ['fournisseur_id','marchandise_id','quantite'];

    public function fournisseur()
    {
            return $this->belongsTo('App\Fournisseur');
    }
    public function marchandise()
    {
        return $this->belongsTo('App\Marchandise');
    }

   public function livraisons()
   {
       return $this->hasMany('App\Livraison');
   }

     
}
