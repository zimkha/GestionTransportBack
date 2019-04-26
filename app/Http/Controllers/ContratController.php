<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contrat;
class ContratController extends Controller
{
    /**
     * 
     * @return  \Illimunate\http\Response
     */

       public function index ()
        {
                $contrats =  Contrat::all();
                 return $contrats;
        }
        /**
         * 
         * @return  \Illimunate\Http\Response
         */
        public function store(Request $request)
        {
            $contrat = Contrat::create($request->all());
            return  $contart;
        }
        /**
         * @param $id
         * 
         * @return \Illimunate\Http\Response
         */
        public function show($id) 
        {
             $contrat = Contrat::findOrfail($id);
               $employe  = $contart->employe;
                   return $contrat; 

        }

         /**
         * @param $id
         * 
         * @return \Illimunate\Http\Response
         */
        public function update(Request $request, $id)
        {
                $contrat = Contrat::findOrfail($id);
                    $contrat->update($request->all());
                     return $contrat;

        }

        /**
         * @param $id
         * 
         * @return \Illimunate\Http\Response
         */
        public function destroy(Request $request, $id)
        {
                $contrat = Contrat::destroy($id);
                  return response()->json($contrat);
        }
}
