<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Controletechnique;
use App\Vehicule;
use App\Resultatcontrole;
class ControletechniqueController extends Controller
{
    /**
     * 
     * @return \Illimunate\Http\Response
     */
    public function index()
    {
       $controle = Controletechnique::all();
          foreach ($controle as  $value) {
             $vehicule = $value->vehicule;
             $resultat = $value->resultat;
          }
          return response()->json($controle);
    }

    /**
     * 
     * @param \Illimunate\Http\Request
     *  @return \Illimunate\Http\Response
     */
    public function store(Request $request)
    {
       $vehicule = Vehicule::findOrfail($request->vehicule_id);
         $resulta = Resultatcontrole::findOrfail($request->resultatcontrole_id);
          $controleT = Controletechnique::create($request->all());
           return response()->json($controleT);
         
    }

    /**
     *  @param $id
     * 
     * @return \Illimunate\Http\Response
     * 
     */

     public function show($id)
     {
         $controle = Controletechnique::findOrfail($id);
            $vehicule = $controle->vehicule;
            $resultat = $controle->resultat;
            return response()->json($controle);
     }

}
