<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typefournisseur;
class TypefournisseurController extends Controller
{
    /**
     * @return \Illimunate\Http\Response
     */
   public function index()
   {
    return response()->json(Typefournisseur::all());
   }

    /**
     * @param \Illimunate\Http\Request 
     * @return \Illimunate\Http\Response
     */
   public function store()
   { 
       return response()->json(Typefournisseur::create($request->all()));
   }
}
