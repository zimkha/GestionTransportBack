<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typecontrat;
class TypeContratController extends Controller
{
    public function index()
    {
        return Typecontrat::all();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $reques)
    {
      return Typecontrat::create($request->all());
    }


    /**
     * Show on Typecontrat
     * @param $id
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
            $type = Typecontrat::findOrfail($id);
               $contrat = $type->contrats;
                 $empl = $contrat->employe;
                 return $type;
     } 

}
