<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reparation;
use App\Vehicule;
use Illuminate\Support\Facades\DB;
class ReparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return Reparation::all();
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
         return Reparation::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Reparation::findOrfail($id);
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
        $reparation = Reparation::findOrfail($id);
         return $reparation->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       return  Reparation::destroy($id);
    }

   /**
    * @param $dte_debu
    * @param $dte_fin
    *
    * @return \Illuminate\Http\Response
    */
  
   public function VehiculePlusRepare($dte_debu= null, $dte_fin= null)
   {
      $res;
      if($dte_debu == null && $dte_fin == null)
            $res = DB::select("SELECT v.id, count(r.id) as cpt from vehicules v, reparations r where v.id = r.vehicule_id  GROUP BY v.id");
        if($dte_debu != null && $dte_fin != null)
        {
            if($this->validateDate($dte_debu) == true && $this->validateDate($dte_fin) == true)
              $res = DB::select("SELECT v.id, count(r.id) as cpt from vehicules v, reparations r where v.id = r.vehicule_id AND r.created_at BETWEEN '$dte_debu' AND '$dte_fin'  GROUP BY v.id");
            return response()->json('erreur de données entre en input'));          
        }
     
        if($res)
        {
            $_max = 0;
            $_cle ;
            foreach ($res as $key => $value) {
                   if($value->cpt > $_max)
                      {
                        $_max = $value->cpt;
                         $_cle =$value->id;
                      }
              }
              $vehicule = Vehicule::find($cle);
              $reparations = $vehicule->reparations;
              return response()->json(array[
                    'vehicule' => $vehicule,
                    'iteration' => $_max
              ]);
        }
   }
    public function validateDate($date, $format = 'Y-m-d')
    {
                $d = DateTime::createFromFormat($format, $date);
                return $d && $d->format($format) == $date;
    }
}
