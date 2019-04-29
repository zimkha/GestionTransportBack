<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typeconge extends Model
{
    protected $fillable = [
        'tc_name',
        'tc_nombre_jr_max'
    ];

public function conges()
{
    return $this->hasMany('App\Conge');
}

}
