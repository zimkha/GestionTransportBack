<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return response()->json(Fournisseur::all());
    }

  


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $ok =  $this->check_fournisseur($request->nom_fournisseur);
             $message ="le fournisseur avec ce  nom".$request->nom_fournisseur. "existe déjà dans la base";
              if($ok == false)
                 return response()->json(Fournisseur::create($request->all()));
            else
              return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fournisseur = Fournisseur::findOrfail($id);
           $receptions = $fournisseur->receptions;
             $typefouniseur  = $fournisseur->typefournisseur;
                return response()->json($fournisseur);  

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
        $fournisseur = Fournisseur::findOrfail($id);
            $fournisseur->update($request->all());
              return response()->json(array('fournisseur' => $fournisseur));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $fournisseur = Fournisseur::findOrfail($id);
           $fournisseur->destroy();
             return response()->json('success', true);

    }

    // 

    /**
     * les functions de verification et statisques
     * 
     * 
     * 
     */



     
    public function check_fournisseur($nomf)
    {
        $ok = false;
      $res = DB::select("SELECT * FROM fournisseurs where nom_fournisseur = '$nomf'");
            if($res != null)
                $ok = true;
        return $ok;

    }

           
}
