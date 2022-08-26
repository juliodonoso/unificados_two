<?php

namespace App\Http\Controllers;

use App\Models\campania;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\c1Export;
use App\Models\campaign;

class CampaniaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $data= campania::all();
        return view('Campanias.Semestral.index', [
        "datos"=>$data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( $ldid)
    {
        $lgestion = campania::find($ldid);
        return view('Campanias.Semestral.script', [
            'ldid'=>$ldid,
            'lgestion'=>$lgestion,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $lid)
    {
        $lck = $request->input("conchk");
        $enviopoliza = $request->input("conchk");

       if($lck == null) {
        $lck = 0;
       } else {
        $lck = 1;
       }
       if($enviopoliza == null) {
        $enviopoliza = 0;
       } else {
        $enviopoliza = 1;
       }


       $lcontra =  $request->input("exampleRadio");
       $lrecepc = $request->input("exampleRadio2");
       $lencuesta = $request->input("exampleRadio4");
       if($lcontra == "NO") {
            $lrecep = "NO";
            $linfo = "NO";
            $lencu = "NO";
            $lescala = 0;
       } else {
            $lrecep = $request->input("exampleRadio2");
            $linfo =  $request->input("exampleRadio3");
            $lencu = $request->input("exampleRadio4");
            $lescala = $request->input("exampleRadio5");
       }
       if($lrecepc == "NO"){
        $linfo = "NO";
        $lencu = "NO";
        $lescala = 0;
       }else {
        $linfo =  $request->input("exampleRadio3");
        $lencu = $request->input("exampleRadio4");
        $lescala = $request->input("exampleRadio5");
       }

       if($lencuesta == "NO"){
        $lescala = 0;
       }else {
        $lescala = $request->input("exampleRadio5");
       }

        $lgrabaraudit = campania::find($lid);
        $lgrabaraudit->contratacion = $request->input("exampleRadio");
        $lgrabaraudit->receppoliza = $lrecep;
        $lgrabaraudit->infor = $linfo;
        $lgrabaraudit->encuesta = $lencu;
        $lgrabaraudit->escala = $lescala;
        $lgrabaraudit->observaciones = $request->input("observ");
        $lgrabaraudit->observaciones2 = $request->input("observaciones2");
        $lgrabaraudit->contacto = $request->input("name");
        $lgrabaraudit->rut = $request->input("rut");
        $lgrabaraudit->mail = $request->input("mail");
        $lgrabaraudit->fono = $request->input("telf");
        $lgrabaraudit->gestion = $request->input("gestion");
        $lgrabaraudit->consulta = $lck;
        $lgrabaraudit->enviopoliza = $enviopoliza;

        $lgrabaraudit->save();

        $datos = campania::select('campanias1.*','gtcampania1.gt as gtc1')
        ->leftjoin('gtcampania1','gtcampania1.id', '=', 'campanias1.gestion')
        ->orderBy('id','desc')->paginate(15);
        // dd($datos);
        return view('Campanias.Semestral.index', [
            'datos'=>$datos,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\campania  $campania
     * @return \Illuminate\Http\Response
     */
    public function show(campania $campania)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\campania  $campania
     * @return \Illuminate\Http\Response
     */
    public function edit(campania $campania)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\campania  $campania
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, campania $campania)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\campania  $campania
     * @return \Illuminate\Http\Response
     */
    public function destroy(campania $campania)
    {
        //
    }


    public function export() {

        $datos = campania::select('campanias1.*','gtcampania1.gt as gtc1')
        ->leftjoin('gtcampania1','gtcampania1.id', '=', 'campanias1.gestion')
        ->get();
        $lname = 'c1-'.'-'.'.xlsx';
        return Excel::download(new c1Export($datos), $lname);

    }
}
