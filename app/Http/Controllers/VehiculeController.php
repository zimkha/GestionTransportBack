<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicule;
class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
         $vehicules = Vehicule::all();
          $type ;
             foreach ($vehicules as $key) {
                
                 $typev = $key->typevehicule;  
             }
             return $vehicules;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
          
            $vehicule  = Vehicule::create($request->all());
            return response()->json($vehicule, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $vehicule = Vehicule::findOrfail($id);
                $type = $vehicule->typevehicule;
            return $vehicule;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $vehicule = Vehicule::findOrfail($id);
            if($vehicule != null){
                $vehicule->update($request->all());
                return response()->json($vehicule, 201);
            }
            else {
                return "erreur";
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Vehicule::destroy($id);
    }
}
