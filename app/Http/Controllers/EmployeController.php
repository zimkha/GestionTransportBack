<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employe;
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
}
