<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\proposal;
use App\Models\import;
use App\Models\period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\proposalimport;
use Maatwebsite\Excel\Facades\Excel;

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
        $agree = period::where('is_act','=',true)->first();
        $lox = $agree->mes; 
        $loa = $agree->anio;       
        $nxfile  = $_FILES['file']['name'];          
        $ruser = Auth::user()->id;                     
        $rcarga = new import();        
        $rcarga->fileimp = $nxfile;        
        $rcarga->emp_id = $ruser;         
        $rid = import::latest('id')->first();
        $idimp = $rid->id;          
        $nroexp = $rid->id+1;      
        $import = new proposalimport($lox,$loa,$nroexp);
        Excel::import($import,request()->file('file'));
        $nroreg = $import->getrowCount();
        $rcarga->noreg = $nroreg; 
        $rcarga->save(); 
        return back();       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clinic  $clinic
     * @return \Illuminate\Http\Response
     */
    public function show(Clinic $clinic)   // Index de Busqueda 
    {
        //
        
        $titulo = 'Busqueda';
        return view('Clinicas.buscar',[
            'titulo' => $titulo,
        ]);

    }


    public function busqueda(Request $request){  
         
        $ult = Period::where('is_act',true)->first();  // Periodo         
        $periodx = Period::all();
        $last = $periodx->last();       
        if($ult == true) {
            $lmes = $ult->mes;
            $lanio = $ult->anio;
            $period = $lmes.$lanio; 
            $cierre = 1;
        } else {
            $lmes = $last->mes;
            $lanio = $last->anio;
            $period = $lmes.$lanio;
            $cierre = 0;
        }      
        // dd($period);

        $input = $request->all();

        if($request->get('buscar')){
     
            $query= proposal::Query()->where('rel','AS');
            $queryadic= proposal::Query()->where('rel','!=','AS');

            $lopcion = $request->input('select1');
            $lbuscar = $request->input('buscar');        

            if($lopcion == 'rut') {   
                $query->Where(trim('rutcar'),$lbuscar)->where('borrado','0')
                ->orwhere(trim('rutter'),$lbuscar)->where('borrado','0');
                $queryadic->where('ruttit',$lbuscar);
            } else {
                $query->where($lopcion,$lbuscar);
                $queryadic->where($lopcion,$lbuscar);
            }
            $lscargas = $queryadic->get();       
            $Nrocar = $lscargas->count();
        
            $propuestas = $query->select('proposals.*','gt1.gestion as gt','tp1.ntipif as tipif', 
            'gt2.gestion as gtcall','tp2.ntipif as tpcall', 'bancos.name as bank')
            ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
            ->leftjoin('Bancos','bancos.codban','=','proposals.banco')                 
            ->get();            
            $titulo = 'Busqueda por '.strtoupper($lopcion).' : '.strtoupper($lbuscar);
            $Nroprop = $propuestas->count();         
         
            return view('Clinicas.buscar_response', [
                'propuestas' => $propuestas,
                'titulo'=>$titulo,
                'lopcion'=>$lopcion,
                'lbuscar'=>$lbuscar,
                'Nrocar'=>$Nrocar,
                'adicionales'=>$lscargas,
                'Nroprop'=>$Nroprop,
                'period'=>$period,
                'cierre'=>$cierre
            ]);
        } else {
            $titulo = 'Busqueda';
            return view('Clinicas.buscar_response',[
                'titulo' => $titulo,
            ]);
        }
    }


    public function editpropuestas($lid) {     
        
        $propedit =  proposal::select('proposals.*','gestion.gestion as gt','tipificacion.ntipif as tp','bancos.name as bank','users.name as ejea')
        ->where('proposals.id',$lid)
        ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
        ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
        ->leftjoin('users','users.id', '=', 'proposals.emp_id')
        ->leftjoin('Bancos','bancos.codban','=','proposals.banco')       
        ->where('borrado', "0")    
        ->get();        
        $lrut = $propedit[0]->rutcar;
        $lprop = $propedit[0]->propuesta;    
        
        $lscargas = proposal::where('ruttit',$lrut)
                    ->where('propuesta',$lprop)
                    ->wherenotin('rel',['AS'])
                    ->get();
        $Nrocar = $lscargas->count();
        $lscoutn = 0;
      
        $titulo = 'Edicion de Propuesta: '.$lid;      

        return view('Clinicas.edit_propuestas',[
            'titulo'=>$titulo,
            'propedit'=>$propedit,
            'lscargas'=>$lscargas,
            'Nrocar'=>$Nrocar,
            'ldid'=>$lid,
            'lscoutn'=>$lscoutn
        ]);

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
