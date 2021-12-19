<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\proposal;
use App\Models\period;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargas = proposal::select('imports.id','imports.fileimp',
        'imports.noreg',
        'imports.created_at',
        'users.name as eje',
        proposal::raw('count(proposals.llave) as count'))        
        ->join('imports','imports.id', '=', 'proposals.import_id')
        ->leftjoin('users','users.id', '=','imports.emp_id')
        ->where('rel','AS')      
        ->where('borrado','0')
        ->groupby('imports.id','imports.fileimp','imports.noreg','imports.created_at','eje')
        ->orderby('id','DESC')
        ->limit(15)
        ->get();

        $perid2 = Period::where('is_act',true)->first();         
        if(!empty($perid2)) {
            $act = $perid2->is_act;
            $pCount = 1;         
        } else {
            $pCount = 0;
        }
        return view('Clinicas.index_import', [
            'cargas'=>$cargas,
            'perid2'=>$perid2,
            'pCount'=>$pCount,
        ]);
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
    public function store(Request $request) // Importacion 
    {
       
        return ("si");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function edit(Clinic $clinic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clinic $clinic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clinic $clinic)
    {
        //
    }
}
