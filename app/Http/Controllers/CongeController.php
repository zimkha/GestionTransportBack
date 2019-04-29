<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conge;
use Illuminate\Support\Facades\DB;
class CongeController extends Controller
{
    /**
     * 
     * @return  \Illimunate\Http\Response
     */

     public function index()
     {
      $current_date = gmDate("Y-m-d");
        
         $datefin = date('2019-11-10');
           $day  =$this->daydif($datefin, $current_date);     
         $conges = Conge::all();
           foreach ($conges as $conge) {
              $employe = $conge->employe; 
           }

           return $conges;

     }

    /**
     *
     *  @param \Illimunate\Http\Request 
     * @return  \Illimunate\Http\Response
     */

     public function store(Request $request)
     {
          // Avant d'enregistre un conge il faut une certaine verification concernnt 
          // l'employe en personne
           $idempl = $request->employe_id; 
                $typeconge = Typeconge::findOrfail($request->typeconge_id);
                    $nbmaxejour = $typeconge->tc_nombre_jr_max;
                     if(is_numeric($nbmaxejour)){
                      $day  =$this->daydif($request->date_fin_conge, $request->date_fin_debut);
                         // caste le resulta en nombre;

                     }
                      
             $date = date_create();
               $date = date_format('Y-m-d', $date);
                $query = DB::select("SELECT * from conges c where c.employe_id = $idempl AND c.date_fin_conge > $date");
                  if($query!=null)
                  {
                    return Conge::create($request->all());
                  }
                  else {
                    return "L'employe a deja un conge en cour";
                  }
         
     }

     /**
     *
     *  @param $id
     * @return  \Illimunate\Http\Response
     */
       public function show($id)

     {
       return Conge::findOrfail($id);
     }

     function dateDifference($startDate, $endDate)
     {
         $startDate = strtotime($startDate);
         $endDate = strtotime($endDate);
         if ($startDate === false || $startDate < 0 || $endDate === false || $endDate < 0 || $startDate > $endDate)
             return false;
            
         $years = date('Y', $endDate) - date('Y', $startDate);
        
         $endMonth = date('m', $endDate);
         $startMonth = date('m', $startDate);
        
         // Calculation du mois
         $months = $endMonth - $startMonth;
         if ($months <= 0)  {
             $months += 12;
             $years--;
         }
         if ($years < 0)
             return false;
        
         // Calculate du daye
                     $offsets = array();
                     if ($years > 0)
                         $offsets[] = $years . (($years == 1) ? ' year' : ' years');
                     if ($months > 0)
                         $offsets[] = $months . (($months == 1) ? ' month' : ' months');
                     $offsets = count($offsets) > 0 ? '+' . implode(' ', $offsets) : 'now';

                     $days = $endDate - strtotime($offsets, $startDate);
                     $days = date('z', $days);   
                    
         return array($years, $months, $days);
     } 


     function daydif($dateFin, $datedebut) {
        $day = DB::select("SELECT DATEDIFF('$dateFin','$datedebut') ");
          return $day;
  }
}
