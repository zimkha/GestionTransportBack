<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reception;
use App\Fournisseur;
use App\Marchandise;
use \DateTime;
use Illuminate\Support\Facades\DB;
use App\Ordemission;
class ReceptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return response()->json(Reception::all());
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $fournisseur = Fournisseur::find($request->fournisseur_id);
             $marchandise = Marchandise::find($request->marchandise_id);
               if($marchandise && $fournisseur)
               {
                    if($request->quantite != null || $request->quantite != 0) {
                            $reception = Reception::create($request->all()) ;
                    }else
                        return "Erreur la quantité de cette reception ne doit pas être null ou égale a zero";
               }else {
                   # code...
               }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $reception = Reception::findOrfail($id);
              $forunisseur = $reception->fournisseur;
                $marchandise = $reception->marchandise;

                return response()->json($reception);
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
         // Si une reception a déjà une livraison ou une orde de mission 
         //alors on ne pue plus modifier la recption ni la supprimer
           $reception = Reception::findOrfail($id);
             if($reception)
             {
                   $reception->update($request->all());
             }

              return response()->json($reception);
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        // Si la reception a une mission et que l'ore de missio a son tour une livraison effectuer
        // Alors On ne peu plus les supprime
            $reception = Reception::findOrfail($id);
            
                        Reception::destroy($id);
                   
                    
        
    }

    /**
     *  Récupére les receptions entre deux dates données
     * 
     * @param $datedebut
     * @param @$datefin
     * @return \Illimunate\Http\Response
     */
    public function getReceptionbyDate($datedebut, $datefin)
    {
        // côté front avec javascript on verifi si les dates sont au bon format
        // côté back on verifi si les dates sont au bon format
            if($this->validateDate('$datedebut') == true && $this->validateDate('$datefin') == true)
            {
                $receptions = DB::select("SELECT * FROM receptions WHERE created_at  BETWEEN '$datedebut' AND '$datefin'");
                foreach ($receptions as $value) {
                    $forunisseur = $value->fournisseur;
                      $marchandise = $value->marchandise;
                }
               return response()->json($receptions);
            }
            else {
             return response()->json("Erreur format de la date");
            }
     
    }

        public function validateDate($date, $format = 'Y-m-d')
            {
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) == $date;
            }

            public function marchandis_more_reception()
            {
            // les marchandise les plus livré
            // cette vfonctionnalité permetra de recupere le ou les marchandises dont la livraison est plus frequent.    
        }

        /**
         * retourne le founisseur qui fais pls de recepetion 
         * 
         * @return \Illimunate\Http\Respnse
         * 
         */
            public function getFournisseur_more_reception()
            {
                $reception = DB::select("SELECT f.id, count(r.id) as cpt FROM receptions r, fournisseurs f where f.id = r.fournisseur_id group BY f.id ");
                   $max = 0;
                   $cle;    
                        if($reception)
                        {
                            foreach ($reception as $key => $value) {
                                  if($value->cpt > $max)
                                      {
                                           $max = $value->cpt;
                                             $cle = $value->id;
                                      }

                            }
                               $fournisseur = Fournisseur::find($cle);
                                    $recptions = $fournisseur->receptions;
                                     
                                    return response()->json(array('fournisseur' => $fournisseur));
                        }                    
                         
            }

            
            /**
             * @param $date  date debut pour les stats
             * @param $df  date fin pour les stats
             * 
             * cette functionn retourne le fournisseur
             * qui a fais plus de reception entre deux dates données
             * 
             * @return \Illimunate\Http\Response
             */
            public function getFournisseur_more_reception_By_date($date, $df)
              {
                    
                $reception = DB::select("SELECT f.id, count(r.id) as cpt FROM receptions r, fournisseurs f where f.id = r.fournisseur_id and r.created_at BETWEEN '$date' and '$df' group BY f.id ");
                $max = 0;
                $cle;    
                     if($reception)
                     {
                         foreach ($reception as $key => $value) {
                               if($value->cpt > $max)
                                   {
                                        $max = $value->cpt;
                                          $cle = $value->id;
                                   }
                         }
                            $fournisseur = Fournisseur::find($cle);
                                 $recptions = $fournisseur->receptions;
                                  
                                 return response()->json(array('fournisseur' => $fournisseur));
                     } 
              }

              /**
               * @param $date  date debut pour les stats
               * @param $df  date fin pour les stats
               * 
               * @return \Illimunate\Http\Response 
               */

               public function getMarchandise_more_reception($date, $df)
               {
                   $reception = DB::select("SELECT m.id COUNT(receptions) as cpt FROM receptions r, marchandises m where m.id = r.marchandise_id and r.cretead_at BETWEEN '$date' AND '$df'");
                      $maxe = 0;
                        $cle;
                           if($reception){
                                 foreach ($reception as $key => $value) {
                                      if($value->cpt > $max){
                                           $max = $value->cpt;
                                            $cle = $value->id;
                                      }
                                 }
                                       $marchandise = Marchandise::find($cle);
                                       $receptions = $marchandise->receptions;
                                       $type_mrchandise = $marchandise->typemarchanidse;
                                         return response()->json(array(
                                             'marchandise' => $marchandise,
                                             'receptions' => $receptions,
                                             'type_marchandise' => $type_mrchandise
                                         ));

                           }
               }

           

}
