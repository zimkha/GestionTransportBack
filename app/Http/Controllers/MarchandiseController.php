<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Marchandise;
use App\Typemarchandise;
use App\Reception;
use App\Fournisseur;
use \DateTime;
use Illuminate\Support\Facades\DB;
class MarchandiseController extends Controller
{

    /**
     * 
     *  @return \Illimuante\Http\Response
     * 
     */
    public function index()
    {
        $marchandises = Marchandise::all();
          return response()->json($marchandises);
    }

    /**
     *  @param \Illimuante\Http\Request
     *  @return \Illimuante\Http\Response
     * 
     */

     public function store(Request $request)
     {
        $type = Typemarchandise::findOrfail($request->typemarchandise_id);
            $marchandise = Marchandise::create($request->all());
              return response()->json($marchandise);
         
     }
     /**
     *  @param $id
     *  @return \Illimuante\Http\Response
     * 
     */

     public function show($id)
     {
          // Avec cette marchandise on pourra recupere tout les commande sur se marchandise 
          // Tous ses livraisons
          // Tous ses fournisseur etc..
       $marchandise = Marchandise::findOrfail($id);
           $type = $marchandise->typemarchandise;
             return response()->json($marchandise);
           
     }
     /** 
      * 
      * @return \Illimuante\Http\Response
      * 
      */
     public function  destroy($id)
     {
           return Marchandise::destroy($id);
     }
     public function update(Request $request, $id)
     {
         
     }
     // donner la marchandise la plus commande sur dure données

     /**
      * @param $datedeut 
      * @param $datefin 
      * @return \Illimunate\Http\Response
      *
      */

      public function getMarchandisplusLivre($datedeut, $datefin)
      {
        /**
         *  Retourner la marchandise la plus livré sur une durée 
         */
         if($this->validateDate($datedeut) == true && $this->validateDate($datefin) == true)
         {
            $query = DB::select("SELECT m.id, COUNT(r.id) as cpt  from marchandises m, receptions r where m.id = r.marchandise_id and r.created_at BETWEEN '2019-03-01' and '2019-08-09' GROUP BY m.id");
                
            if($query)
                {
                    $cle;
                    $max = 0;
                   foreach ($query as $key =>  $value) {
                         if($value->cpt > $max)
                         {
                            $max = $value->cpt;
                             $cle = $value->id;  
                         }
                   }
                   $marchandise = Marchandise::find($cle);
                      $receptions = $marchandise->receptions;
                         
                         foreach($receptions as $value)
                         {
                             $four = $value->fournisseur;
                         }
                       return response()->json(array('marchandise' => $marchandise,'nombre maxe' => $max));
                }
         }
         else {
           return response()->json('Les dates ne sont pas valides');
         }
         

      }
     /**
      * @param $datedeut 
      * @param $datefin 
      * @return \Illimunate\Http\Response
      *
      */

      public function getMarchandisplusComande()
      {
        /**
         *  Retour le marchandise le plus commande pour une duré
         *  
         */
      }

      public function validateDate($date, $format = 'Y-m-d')
      {
          $d = DateTime::createFromFormat($format, $date);
          return $d && $d->format($format) == $date;
      }
}
