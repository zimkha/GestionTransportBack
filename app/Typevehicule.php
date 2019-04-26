<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typevehicule extends Model
{
    protected $fillable = [
        'tp_name',
        'description',
    ];

    public function Vehicules()
    {
        return $this->hasMany('App\Vehicule');
    }
}
