<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typefournisseur extends Model
{
    protected $fillable = ['tp_name'];

    public function fournisseurs()
    {
        return $this->hasMany('App\Fournisseur');
    }
}
