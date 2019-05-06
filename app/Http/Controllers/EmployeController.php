<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
use App\Contrat;
use App\Departementempl; 
class EmployeController extends Controller
{
   /**
    *  @return \Illimunate\Http\Response
    */
    public function index()
    {
      return  Employe::all();
    }

  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
          // pour enregistre un employer il faut 
          // enregistre en meme temps un un contrat pour l'employer
          // l'enregistre d'un employer appele  3 tables de la base de donnees (emplyes, departementempls, contrat)
            $employe = Employe::create(array(
               'ep_nomcomplet' => $request->ep_nomcomplet,
               'ep_nci' => $request->ep_nci,
               'ep_adresse' => $request->ep_adresse,
               'ep_situation_m' => $request->ep_situation_m,
               'ep_nb_enfants' => $request->ep_nb_enfants,
               'ep_poste' => $request->ep_poste
            ));
              $employe->save();
             $contrat_employer = Contrat::create(array(
               'employe_id' => $employe->id,
               'typecontrat_id' => $request->typecontrat_id,
               'date_debut_contrat' => $request->date_debut_contrat,
               'date_fin_contrat' => $request->date_fin_contrat,
               'status' => true,
               'salaire_brute' => $request->salaire_brute,
               'salaire_net' => $request->salaire_net
             ));
             $dep_emp = Departementempl::create(array(
                'employe_id' => $employe->id,
                'departement_id' => $request->departement_id
             ));
             $dep_emp->save();
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id)
     {
         if(is_numeric($id)){
           
            $employe = Employe::find($id);
            if($employe){
            $contrats = $employe->contrats;
               $current_contrat = $this->getLastContrat($employe);
             if($employe->ep_poste =="chauffeur" && $current_contrat){
                 $affectations = $current_contrat->affectations;

                 return response()->json(array(
                  'employe' => $employe,
                  'contrat_courant' => $current_contrat
                 ));   
             }
              return $employe;
           }else {
              return "cette employer n'existe pas dans la base";
           }
         
         }
         else{
           return "le parametre  doit etre un number";
         }
         
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Employe $employe){

    }

    public function delete(Request $request, Employe $employe){

    }


    /**
     * 
     *  Les functions de filtre
     *   pour la gestions des employes
     * 
     */

    public function getLastContrat(Employe $employe)
    {
      $current_date = gmdate('Y-m-d');
      $query = DB::select("SELECT * from contrats c.id where c.employe_id = '$employe->id' and c.date_fin_contrat > '$current_date'");
       if($query){
         $contrat = Contrat::find($query->id);
         return $contrat;
       }
       return  false;
        
    }
}
