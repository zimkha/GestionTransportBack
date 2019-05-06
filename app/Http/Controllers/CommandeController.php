<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commande;
use App\Client;
use Event;
use App\Events\RegisterClient;
use App\Events\RegisterCommande;
use Illuminate\Support\Facades\DB;
use App\CommandeMarchandise;
use App\Listeners\NotificationUserMailListener as lisener; 
class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return  Commande::all();
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

        $commande = Commande::create($request->all());
       
       event(new RegisterCommande($request->client_id)) ;
        return response()->json($commande);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
           $commande = Commande::findOrfail($id);
           $client = $commande->client;
           return response()->json($commande); 
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
        // si une commande est deja regle ou elle a déja une livraison,  alors elle ne peu plus etre modfier cependant
        // Elle peur etre supprime par l'administrateur
        $commande = Commande::findOrfail($id);
          if($this->checkCommande($commande) != true)
          
               return $commande->update($request->all());

          else
             return response()->json('la commande a déja une livraison');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Seul les admins peuvent acceder a cette action
         $commande  = Commande::findOrfail($id);
          if($this->checkCommande($commande) !=true)
             return Commande::destroy($id);
         else 
            return response()->json("cette commande ne peu pas etre supprime elle es liée a une ou des livraisons ou elle est déj regle");
    }

   /**
    *  @param $datedebu
    *  @param $datefin
    *  @return \Illimunate\Http\Response
    *
    */
    public function getClientPlusCommander($datedebut = null, $datefin = null)
    {
        // cette function retourne le client qui plus commander 
  
        $commande= null;
          $_max = 0;
          $_cle;
           // si les deux dates ne sont pas nulls et qu'elles sont valides 
            if(($datedebu!= null && $datefin != null) &&
             ($this->validateDate($datedebu) == true &&
              $this->validateDate($datefin) == true))        
                $commandes = DB::select("SELECT c.id, count(cm.id)  as cpt FROM commndes cm , clients c where c.id = cm.client_id and cm.created_at BETWEEN '$datedebu' AND '$datefin' GROUP BY c.id");
                
            if($datedebu== null || $datefin == null)
                  $commandes =DB::select("SELECT c.id, count(cm.id)  as cpt FROM commndes cm , clients c where c.id = cm.client_id GROUP BY c.id");

               //si la variable commandes n'est pas null 
                if($commandes)
                {
                  foreach ($commandes as $key => $value) {
                       if($value->cpt > $_max)
                          {
                            $_max = $value->cpt;
                            $_cle = $value->id;
                          }
                  }
                   $client = Client::find($_cle);
                   return response()->json($commandes, $client);       
                }else 
                    return response()->json('pas de livraisons entre ces deux dates');

            
    }

  public function validateDate($date, $format = 'Y-m-d')
  {
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) == $date;
  }
  /**
   *  Cette fonction verifie si la commande a déjà une livraison ou si elle est déja regle
   *  @param \App\Commande $commane
   *  @return \Illimunate\Http\Response
   *
   */
  public function checkCommande(Commande $commande)
  {
    $livraisons = DB::select("SELECT * FROM livraisons l where l.commande_id = '$commande->id'");
      if($livraisons)

         return true;
     else
        return false;
  }
}
