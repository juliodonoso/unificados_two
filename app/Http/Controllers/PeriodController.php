<?php

namespace App\Http\Controllers;

use App\Models\period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $ult = Period::get()->last();
        $perid = Period::where('is_act',true)->first();   
        if(empty($perid)) {
            $pCount = 1;
        } else {
            $pCount = 0;
        }              
        $titulo = "Periodo de Gestion";
        return view('calidad.periodo')
        ->with('titulo',$titulo)
        ->with('perid',$perid)
        ->with('pCount',$pCount)
        ->with('ult',$ult);   
    }


    public function close($id)
    {
        $pclose=Period::where('id', '=', $id)->first();
        $pclose->is_act = false;
        $pclose->save();       
        $perid = Period::where('is_act',true)->first();   
        if(empty($perid)) {
            $pCount = 1;
        } else {
            $pCount = 0;
        }  
        $ult = Period::get()->last();          
        $titulo = "Periodo de Gestion";
        return view('calidad.periodo')
        ->with('titulo',$titulo)
        ->with('perid',$perid)
        ->with('pCount',$pCount)
        ->with('ult',$ult); 
    }

    public function abrir()
    {
        $emp_idu =  Auth::user()->id;
        $titulo = "Periodo de Gestion";
        $ult = Period::get()->last();
        $ultmes = $ult->mes;
        $ultanio = $ult->anio;
        if($ultmes == 12){
            $mesopen = 1;
            $aniopen = $ultanio+1;
        }else {
            $mesopen = $ultmes+1;
            $aniopen = $ultanio;
        } 
        $perid = new period();
        $perid->mes = $mesopen;
        $perid->anio = $aniopen;
        $perid->emp_id = $emp_idu;
        $perid->is_act = true;
        $perid->save();
        $pCount = 0;       
        return view('Calidad.Periodo')
        ->with('pCount',$pCount)
        ->with('perid',$perid)
        ->with('titulo',$titulo);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function show(period $period)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function edit(period $period)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, period $period)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\period  $period
     * @return \Illuminate\Http\Response
     */
    public function destroy(period $period)
    {
        //
    }
}
