<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departement;
class DepartementController extends Controller
{
    public function index()
    { 
    	return Departement::all();
    }
   /**
    * @param \Illimunate\Http\Request
    * @return \Illimunate\Http\Response
    */
    public function store(Reques $request)
    {
    		return Departement::create($request->all());
    }

   /**
    *
    * @param $id
    * @return \Illimunate\Http\Response 
    *
    */
}
