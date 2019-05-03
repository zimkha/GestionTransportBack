<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typepaiement extends Model
{
    protected $fillable = ['tp_name'];

    public function paiements()
    {
        return $this->hasMany('App\Paiment');
    }
}
