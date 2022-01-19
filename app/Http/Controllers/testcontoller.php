<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class testcontoller extends Controller
{
    //

    public function pruebas() {

        
    $canal =  \DB::table('canal')
    ->get();

    $operadores =  \DB::table('teleoperadores')
    ->get();

    return view('Clinicas.scriptsclinics');
   


    }
}
