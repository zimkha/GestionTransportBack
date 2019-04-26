<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typevehicule;
class TypevehiculeController extends Controller
{
    public function index()
    {
         return Typevehicule::all();
    }
    /**
     *  @param \Illuminate\http\Request
     * 
     *  @return \Illuminate\http\Response
     * 
     */
    public function store(Request $request)
    {   
    
        $name = $request->tp_name;
          if(strlen(trim($name)) > 3){
            $type = Typevehicule::create(array(
                'tp_name' => $request->tp_name,
                'description' => $request->description 
             ));
              return response()->json($type); 
          }
          else {
                $message ="Veillez revoir les données entrés elles ne sont pas conforme";
              return response()->json($message);
          }
           
         
    }

    public function update(Request $request, $id){
          $typevehucile = Typevehicule::findOrfail($id);
             if($typevehucile!=null){
                $typevehucile->update($request->all());
                return response()->json($typevehucile, 201);
             }
             else{
                 return "erreur";
             }
             
    }

    /**
     *  @param $id
     * 
     * @return \illuminate\Http\Response
     */
    public function show($id)
    {
          $typevehicule = Typevehicule::findOrfail($id);
            $vehicules = $typevehicule->vehicules;
        return response()->json(array(
           'type' => $typevehicule
          
        ));
    }


    /**
     *  @param $id
     * 
     * @return \illuminate\Http\Response
     */

    public function destroy(Request $request, $id){
          $type = Typevehicule::destroy($id);
            return response()->json($type);
    }



    /**
     * Partie pour les Fonctions de  filter 
     *  
     */


     /**
      *  @param $chaine
      */
     public function listeBytype($chaine)
     {
          
     } 
}
