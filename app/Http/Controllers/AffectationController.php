<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Affectation;
use App\Vehicule;
use App\Employe;
use \DateTime;
use Illuminate\Support\Facades\DB;

class AffectationController extends Controller
{
    public function index()
    {
        return Affectation::all();
    }

    public function affectations_valide()
    {
        return Affectation::where('statut',  1)->get();
    }

    /**
     * 
     * @param  @return \Illimunate\Htpp\Request
     *  @return \Illimunate\Htpp\Response
     * 
     */
    public function store(Request $request)
    {
        // verifie si l'employe est un chauffeur
        // On verifie si l'employe n'a pas une affectaionen cours 
        //
          $employe_id =  Employe::find($request->employe_id);
               $vehicule_id = Vehicule::find($request->vehicule_id);
             if($employe_id && $vehicule_id)
             {
                $ok = $this->check_poste($employe_id);
                // check if this employe is a driver
                if($ok== true)
                {
                      $statut = $this->check_statut($employe_id, $request->vehicule_id);
                        if($statut == true)
                        {
                            $affectation = Affectation::create($request->all());
                              return $affectation;
                        }   
                        else {
                            return "le chauffeur ou le vehicule est indisponible pour une affectation";
                        }
                }
                else {
                    return "Une affectation ne doit se faire que pour un chauffeur";
                }
             }
             else {
                 return "erreur impossible de trouve l'employe ou la voiture ";
             }
           
    }
    /**
     * @param $id
     * 
     * @return \Illimunate\Http\Response
     */
    public function show($id)
    {
         $affectation = Affectation::findOrfail($id)->first();
             $employe =  $affectation->employe;
               $vehicule = $affectation->vehicule;
                return $affectation ;
    }

     /**
     * @param $id
     * 
     * @param \Illimunate\Http\Request
     * @return \Illimunate\Http\Response
     */
    public function update(Request $request, $id)
    {
             $affectation = Affectation::findOrfail($id);    
              if ($affectation) 
              {
                  // le resultat retourner c'est un true si sa passe sinon c'est false
                   if($request->employe_id && $request->vehicule_id)
                    {
                           $employe = Employe::findOrfail($request->employe_id);
                           $vehicule = Vehicule::findOrfail($request->vehicule_id);
                             if($this->check_poste($employe->id) == true)
                                $affectation->employe_id = $employe->id;
                                $affectation->vehicule_id = $vehicule->id;
                                $result  = $affectation->update($request->all());
                           return response()->json($result);
                    }    
              }
              //else {
                //  return "impossible de trouver cette affectation";
              //}
               
    }

    public function destroy($id)
    {
        return Affectation::destroy($id);
    }

    /**
     * @param $id
     * @return boolean 
     */
    public function check_poste($id)
     {
         $res = DB::select("SELECT * FROM employes WHERE ep_poste = 'chauffeur' and id = '$id'");
           if($res!=null)
             return true;

        return false;
            
    }
   /**
    * @param $idem
    * @param $idv
    * @return boolean
    */
    public function check_statut($idem , $idv)
    {
        $current_date = gmDate("Y-m-d");
          $ok = false;
           $ok_ve = false;
        $res_emp = DB::select("SELECT * from affectations af where af.employe_id = '$idem' AND af.date_fin_af > '$current_date' GROUP BY af.employe_id");
          if($res_emp!=null)
               $ok = true;
          $res_veh = DB::select("SELECT * from affectations af where af.vehicule_id = '$idv' and af.date_fin_af > '$current_date' GROUP BY af.vehicule_id");
            if($res_veh!=null)
                $ok_ve = true;
          
                if($ok == false && $ok_ve == false)
                {
                    return true;
                }
                else {
                    return false;
                }
    }

    /**
     * 
     * 
     */
    public function update_statut()
    {
        // Cette fonction modifi la status  des affectations lorsque la date de 
        $current_date = gmDate("Y-m-d");
      $tabAff =  DB::select("SELECT * from affectations where date_fin_af = '$current_date'");
         if($tabAff!=null)
         {
              foreach ($tabAff as $value) {
                    $value->date_fin_af = 0;
              }
         }
    }
    /**
     * 
     * @param $datedebu
     * @param $datefin
     * @param $id
     * @return \Illimunate\Http\Response
     * 
     */
    public function getLivraisonAffBydDat($id, $datedebu , $datefin )
    {
         // cette fonction retourne l'affectation et ses livraisons entre deux dates données
        // meme si cette affectation n'est plus en cours 
         $affectation = Affectation::findOrfail($id);
         $vehicule = $affectation->vehicule;
         $chauffeur = $affectation->employe;
         //Gere les differents erreurs concernant les dates
         if($this->validateDate($datedebu) == true && $this->validateDate($datefin) == true)
         
            $livraisons = DB::select("SELECT * FROM livraisons l where l.affectation_id = '$id' AND l.created_at BETWEEN '$datedebu' AND '$datefin'");
               if($livraisons)
                  $affectation->livraisons = $livraisons;
         }
           return response()->json($affectation);

    }

        public function validateDate($date, $format = 'Y-m-d')
            {
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) == $date;
            }
}
