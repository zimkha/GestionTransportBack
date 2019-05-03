<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {return Client::all(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
           $client = Client::create($request->all());
             return response()->json($client); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $client  = Client::find($id);
         if($client){  
             $commandes = $client->commandes;
              return response()->json($client);
            }
            else
                return response()->json('erreur de données');
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
              $client = Client::findOrfail($id);
              $client->update($request->all());
              return response()->json($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Client::destroy($id);
        return response()->json($response);

    }
    /**
     *  Retourn le client qui plus fais de commande 
     *
     * @return \Illimunate\Http\Response 
     */
    public function getClientPlusCommander()
    {
      $client_response = DB::select("SELECT cl.id, COUNT(cm.id) as cpt FROM clients cl, commandes cm WHERE cl.id = cm.client_id GROUP BY cl.id");
             $max = 0;
             $cle ;
           if($client_response)
           {
              foreach ($client_response as $key => $value) {
                   if($value->cpt > $max)
                   {
                    $max = $value->cpt;
                    $cle = $value->id;
                   }
              }
                  $client = Client::find($id);
                  $commandes = $client->commandes;
                   return response()->json($client);
           }
    }
}
