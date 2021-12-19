<?php

namespace App\Http\Controllers;

use App\Models\proposal;
use Illuminate\Http\Request;
use App\Models\period;
use App\Models\import;
use Carbon\Carbon;
use App\Exports\proposalExport;
use App\Exports\DuplicidadExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\proposalimport;
use App\Imports\Updateimport;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use PDF;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *@return \Illuminate\Support\Collection
     */
     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()    // Index de la importacion

    {        //

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

        $titulo = "Importacion de Propuestas";
        return view('Calidad.importar')
        ->with('titulo',$titulo)
        ->with('pCount',$pCount)
        ->with('cargas',$cargas);
    }

    /**
         * Show the form for creating a new resource.
         *
         * 
         * @return \Illuminate\Support\Collection
     */
  
    public function create()     // importacion de las propuestas
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
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Support\Collection
     */
    public function store(Request $request)  // Vacia 
    {
        //
    }

    /**
         * Display the specified resource.
         *
         * @param  \App\Models\proposal  $proposal
         * @return \Illuminate\Http\Response
     */

    // Busquedas 

    public function show(proposal $proposal)    // Index de las Busquedas
    {
        //
      
        $titulo = "Busquedas de Propuestas";
        return view('Calidad.busquedas')
        ->with('titulo',$titulo);

    }

    public function showb()  // Resultado de las Busquedas
    {
        $ult = Period::where('is_act',true)->first();  // Periodo         
        $periodx = Period::all();
        $last = $periodx->last();       
        if($ult == true) {
            $lmes = $ult->mes;
            $lanio = $ult->anio;
            $period = $lmes.$lanio; 
            $patst = 1;
        } else {
            $lmes = $last->mes;
            $lanio = $last->anio;
            $period = $lmes.$lanio;
            $patst = 0;
        }      
        $lopcion  = $_POST['sel01b'];
        $lbuscar  = trim($_POST['objb']); 
        $query = proposal::query(); 
        $queryadic = proposal::query(); 
        if($lopcion == 'rut') {   
            $query->Where(trim('rutcar'),$lbuscar)->where('borrado','0') ->where('rel','AS')
            ->orwhere(trim('rutter'),$lbuscar)->where('borrado','0') ->where('rel','AS');
            $queryadic->where('ruttit',$lbuscar);
        } else {
            $query->where($lopcion,$lbuscar);
        }
        $propuestas = $query->select('proposals.*','gt1.gestion as gt','tp1.ntipif as tipif', 
        'gt2.gestion as gtcall','tp2.ntipif as tpcall', 'bancos.name as bank')
        ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
        ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
        ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
        ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
        ->leftjoin('Bancos','bancos.codban','=','proposals.banco')                 
        ->get(); 
        $PropCount = $propuestas->count();   
           
        // if($lopcion == 'rut') {    
        //     $propuestas = proposal::select('proposals.*','gt1.gestion as gt','tp1.ntipif as tipif', 'gt2.gestion as gtcall','tp2.ntipif as tpcall', 'bancos.name as bank')
        //     ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
        //     ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
        //     ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
        //     ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
        //     ->leftjoin('Bancos','bancos.codban','=','proposals.banco')            
        //     ->Where(trim('rutcar'),$lbuscar)            
        //     ->where('borrado','0')          
        //     ->get();         
        // } else {
        //     $propuestas = proposal::select('proposals.*','gt1.gestion as gt', 'gt2.gestion as gtcall','bancos.name as bank')
        //     ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
        //     ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
        //     ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
        //     ->leftjoin('Bancos','bancos.codban','=','proposals.banco')
        //     ->where($lopcion,$lbuscar)
        //     ->where('borrado','0')
        //     ->get(); 
        // }      
             
        $adicionales = proposal::select('proposals.rutcar','proposals.nom','proposals.pat',
        'proposals.mat','proposals.propuesta','proposals.mes','proposals.anio')
        ->where('ruttit',$lbuscar)                 
        ->wherein('rel',['CO','HI','OT']) 
        ->where('borrado','0')
        ->groupby('proposals.rutcar','proposals.nom','proposals.pat',
        'proposals.mat','proposals.propuesta','proposals.mes','proposals.anio')
        ->get();    

        $Nrocar = $adicionales->count();      
        $titulo = "Consulta de Propuestas";        
        return view('Calidad.Nuevos.bqind')
        // return view('Calidad.result')
        ->with('titulo',$titulo)
        ->with('propuestas',$propuestas)
        ->with('lbuscar' ,$lbuscar )
        ->with('lopcion',$lopcion)
        ->with('adicionales',$adicionales)
        ->with('Nrocar',$Nrocar)
        ->with('period',$period)
        ->with('patst',$patst)
        ->with('PropCount',$PropCount);

    }

    public function export(Request $request, $lopcion,$lbuscar)     // Exportar Busquedas
    {
        
          
        if($lopcion == 'rut') {             
            // $propuestas = proposal::select('proposals.*','gestion.gestion as gt','bancos.name as bank')
            // ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
            // ->leftjoin('Bancos','bancos.codban','=','proposals.banco')
            // ->where('ruttit',$lbuscar)            
            // ->orWhere('rutter',$lbuscar)
            // ->where('is_del',false) 
            // ->get(); 
            $propuestas = proposal::select('numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
            'sex','fnac','rel','propuesta','rutter','dvter','nombreter',
            'fechavta','rutsup','ejecutivo','llave','uf','supervisor','ejecutiva','fechaent','clinica','tipo','origen','clasif','observaciones')
            ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
            ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
            ->leftjoin('bancos','bancos.codban', '=', 'proposals.banco')
            // ->where('is_del',false)           
            ->where('ruttit',$lbuscar)            
            ->orWhere('rutter',$lbuscar)
            ->where('borrado','0')            
            ->get(); 


        } else {
            // $propuestas = proposal::select('proposals.*','gestion.gestion as gt','bancos.name as bank')
            // ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
            // ->leftjoin('Bancos','bancos.codban','=','proposals.banco')
            // ->where($lopcion,$lbuscar)
            // ->where('is_del',false) 
            // ->get();    
            $propuestas = proposal::select('numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
            'sex','fnac','rel','propuesta','rutter','dvter','nombreter',
            'fechavta','rutsup','ejecutivo','llave','uf','supervisor','ejecutiva','fechaent','clinica','tipo','origen','clasif','observaciones')
            ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
            ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
            ->leftjoin('bancos','bancos.codban', '=', 'proposals.banco')
            ->where('is_del',false) 
            ->where($lopcion,$lbuscar)           
            ->get();    
            


        }
      
        $lname = $lopcion.'-'.$lbuscar.'.xlsx';        
        // return Excel::download(new ProposalExport($propuestas), $lname);
        return Excel::download(new DuplicidadExport($propuestas), $lname);
    }    

    /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Models\proposal  $proposal
         * @return \Illuminate\Support\Collection
     */

    public function duplicidad(proposal $proposal)    // index de la Duplicidad
    {
        //
        $titulo = "Consulta de Duplicidad";
        return view('Calidad.duplicidad')
        ->with('titulo',$titulo);
    }
    /**
        *@return \Illuminate\Support\Collection
    */
    public function verifduplic()    // Resultado de duplicidad
    {
        //
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $periodx = Period::all();
        $last = $periodx->last();       
        if($ult == true) {
            $lmes = $ult->mes;
            $lanio = $ult->anio;
            $period = $lmes.$lanio;
            $patst = 1; 
        } else {
            $lmes = $last->mes;
            $lanio = $last->anio;
            $period = $lmes.$lanio;
            $patst = 0;
        }
        $lopcion = $_POST['sel01b'];         
        $file = request()->file('file');
        $documento =  IOFactory::load($file);
        $totalDeHojas = $documento->getSheetCount(); 
        for ($indiceHoja = 0; $indiceHoja < $totalDeHojas; $indiceHoja++) {
            $hojaActual = $documento->getSheet($indiceHoja);
            $nFilas = $hojaActual->getHighestRow();     // Ultima fila           
            $larray = [];
            $info = [];
            $propuestas = [];
            $lnum = 0;
            for ($i = 1; $i <= $nFilas; $i++) {              
                $coord = "A".strval($i);  
                $coord2 = "B".strval($i);
                $coord3 = "C".strval($i); 
                $coord4 = "D".strval($i);                
                $celda = $hojaActual->getCell($coord); 
                $celdax = $hojaActual->getCell($coord2); 
                $celday = $hojaActual->getCell($coord3); 
                $celdaz = $hojaActual->getCell($coord4); 
                $celda2 = strval($celda); 
                $celdax2 = 'Para Clinica: '.strval($celdax).' - Plan: '.strval($celdaz) .' - Por el Ejecutivo: '.strval($celday);   
                $larray [] = $celda2;
                $info [] = $celdax2;               
                // array_push($info,$celdax2);                                       
            }  
            $larr_actual = array_combine($larray, $info);
            
            // dd($larr_actual);            
            foreach ($larray as $lbuscar) {  
                // echo $lbuscar;
                // if($lopcion == 'rut') {                 
                //     $ldatos = proposal::select('proposals.*','gestion.gestion as gt','tipificacion.ntipif as tp','bancos.name as bank')
                //     ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
                //     ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
                //     ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
                //     ->where('is_del', false) 
                //     ->where('rel','AS')                   
                //     ->where('rutcar',$lbuscar)  
                //     ->orWhere('rutter',$lbuscar)                                             
                //     ->get(); 
                //     // dd($ldatos); 
                //     $propuestas [] = $ldatos;                    
                //     $lh = count($ldatos);   
                //     $lnum = $lnum+$lh;                        
                // } 
                if($lopcion == 'rut') {                 
                    $ldatos = proposal::select('proposals.rutcar','proposals.pat','proposals.mat','proposals.nom')
                    // ->where('is_del', false) 
                    // ->where('rel','AS')                   
                    ->where('rutcar',$lbuscar)                  
                    ->groupby('rutcar','pat','mat','nom') 
                    ->where('borrado','0')                                          
                    ->get(); 
                    // dd($ldatos);
                    $lh = count($ldatos);   
                    if($lh>0) {
                        $propuestas [] = $ldatos;                    
                    }
                    $lnum = $lnum+$lh;                        
                } 
             
                              

                
                // if ($lopcion == 'telf') {
                //     $ldatos = proposal::select('proposals.*','gestion.gestion as gt','tipificacion.ntipif as tp','bancos.name as bank')
                //     ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
                //     ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
                //     ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
                //     ->where('is_del', false) 
                //     ->where('rel','AS')                 
                //     ->where('telf',$lbuscar)                    
                //     ->get(); 
                //     $propuestas [] = $ldatos; 
                // }
                $lreg = count($ldatos);              
            }

            $lnum = $lnum-1;
            $lo = sizeof($propuestas);           
            if($lnum > $lo) {
                $lnum = $lo;
            }            
            $lreg = count($propuestas);   
          
            $adicionales = proposal::select('proposals.rutcar','proposals.nom','proposals.pat',
            'proposals.mat','proposals.propuesta','proposals.mes','proposals.anio')
            // ->where('ruttit',$lbuscar) 
            ->wherein('ruttit',$larray)  
            ->wherein('rel',['CO','HI','OT']) 
            // ->where('is_del',false) 
            ->where('borrado','0')
            ->groupby('proposals.rutcar','proposals.nom','proposals.pat',
            'proposals.mat','proposals.propuesta','proposals.mes','proposals.anio')
            ->get(); 
            $Nrocar = 0;                            
            $titulo = "Consulta de Duplicidad";  
            // dd($propuestas);              
            return view('Calidad.ResultDuplic')           
            ->with('titulo',$titulo)            
            ->with('lbuscar',$lbuscar)            
            ->with('propuestas',$propuestas)
            // ->with('carray',$carray)
            ->with('Nrocar',$Nrocar)
            ->with('lopcion',$lopcion)
            ->with('larray',$larray)
            ->with('adicionales',$adicionales)
            ->with('period',$period)
            ->with('patst',$patst)
            ->with('lreg',$lreg)
            ->with('larr_actual',$larr_actual);
        }/**
        *@return \Illuminate\Support\Collection
    */
    }           
     public function expDuplic(Request $request, $sep,$lbuscar,$lopcion)     // Exportar Duplicidad
    {        
        $larray2 = explode(",",$sep); 
        $query = proposal::query();
        if($lopcion == 'rut') { 
            $propuestas = $query->select('numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
            'sex','fnac','rel','propuesta','rutter','dvter','nombreter',
            'fechavta','rutsup','ejecutivo','llave','uf','supervisor','ejecutiva','fechaent','clinica','tipo','origen','clasif','observaciones')
            ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
            ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
            ->leftjoin('bancos','bancos.codban', '=', 'proposals.banco')
            // ->where('is_del',false) 
            ->where('borrado','0')
            ->wherein('rutcar', $larray2)  
            ->orWherein('rutter', $larray2)            
            ->get(); 
                     
            // $propuestas = proposal::select('proposals.*','gestion.gestion as gt','bancos.name as bank')
            // ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
            // ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
            // ->wherein('rutcar', $larray2)  
            // ->orWherein('rutter', $larray2)
            // ->where('is_del',false) 
            // ->get();                 
        } else {
            // $propuestas = proposal::select('proposals.*','gestion.gestion as gt','bancos.name as bank')
            // ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
            // ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
            // ->where($lopcion,$lbuscar)
            // ->where('is_del',false) 
            // ->get();  
            $propuestas = $query->select('numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
            'sex','fnac','rel','propuesta','rutter','dvter','nombreter',
            'fechavta','rutsup','ejecutivo','llave','uf','supervisor','ejecutiva','fechaent','clinica','tipo','origen','clasif','observaciones')
            ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
            ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
            ->leftjoin('bancos','bancos.codban', '=', 'proposals.banco')
            // ->where('is_del',false) 
            ->where('borrado','0')
            ->where($lopcion,$lbuscar)  
            ->get(); 

        }
      
        // $lname = $lopcion.'-'.$lbuscar.'.xlsx';        
        $lname = 'Duplic.xlsx';
        return Excel::download(new DuplicidadExport($propuestas), $lname);
    }    

    public function updategestion() // Actualizar Gestion index
    {
        //
        $titulo ="Actualizar Gestion";
        return view('calidad.upgestion')
        ->with('titulo',$titulo);
    }

    public function updateexcel(Request $request) // Carga de Actualizacion de Gestion 
    {              
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $lmes = $ult->mes;
        $lanio = $ult->anio;   
        $lsarray = [];   
        $lrarray = [];  
        $Excelup =  Excel::toCollection(new UpdateImport,request()->file('file')); 
        foreach($Excelup[0] as $upgestion2)
        {
           $lrut = $upgestion2['rutcar'];
           $lrarray [] = $lrut;          
        }
        $loArray = count($lrarray); 
        $lregup = 0;
        foreach($Excelup[0] as $upgestion)

      
        {         
            $wordlist = Proposal::where('rutcar', $upgestion['rutcar'])
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('rel','AS')            
                ->where('borrado','0')
                ->get();
            $wordCount = $wordlist->count();   
            if($wordCount > 0) {
                Proposal::where('rutcar',$upgestion['rutcar'])
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('rel','AS')               
                ->where('borrado',"0")
                // ->update([$rest]);
                ->update([
                'gestion' => $upgestion['gestion'],
                'tipificacion' => $upgestion['tipificacion'],
                'Observaciones' => strtoupper($upgestion['observaciones']),
                'gtcall' => $upgestion['gtcall'],
                'tpcall' => $upgestion['tpcall'],
                'subtipif' => $upgestion['subtipif'],
              
                ]);

                $lregup = $lregup+1;
            }
            
        }
        // dd($lregup);
        foreach($Excelup[0] as $upgestion)
        {
            $lvistaup = proposal::select('proposals.*','gt1.gestion as gt','tp1.ntipif as tp',
            'gt2.gestion as gtcall','tp2.ntipif as tpcall','tp3.ntipif as subtp')
                // ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
                // ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')    
                ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
                ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
                ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
                ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
                ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')      
                ->where('rutcar', $upgestion['rutcar'])
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('rel','AS')         
                ->where('borrado',"0")
                ->get();           
                $lsarray [] =  $lvistaup;
        }

        $titulo = 'Registros Actualizados';
        return view('Calidad.updatelist')
        ->with('titulo',$titulo)
        ->with('lsarray',$lsarray)
        ->with('lrarray',$lrarray)
        ->with('loArray',$loArray)
        ->with('lregup',$lregup);
        
    }

    public function pdfproposal(Request $request, $sep,$lbuscar,$lopcion)   // pdf duplicidad
    {
        $larray2 = explode(",",$sep);     
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $officialDate = $date->format('d-m-Y H:i:s');
        if($lopcion == 'rut') {                        
            $propuestas = proposal::select('proposals.*','bancos.name as bank')           
            ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
            ->wherein('rutcar', $larray2)  
            ->orWherein('rutter', $larray2)
            // ->where('is_del',false)
            ->where('borrado','0')
            ->get();                 
        } else {
            $propuestas = proposal::select('proposals.*','bancos.name as bank')         
            ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
            ->where($lopcion,$lbuscar)
            // ->where('is_del',false)
            ->where('borrado','0')
            ->get();     
        }
        $pdf = PDF::loadview('Calidad.pdfduplic',['propuestas'=>$propuestas],['officialDate'=>$officialDate]); 
        $pdf->setpaper('a4','landscape');        
        return $pdf->stream("duplicidad.pdf",array("Attachment" => 0));
    }

    public function pdfupdate(Request $request, $sep)
    {
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $officialDate = $date->format('d-m-Y H:i:s');
        $propuestas = [];
        $larray2 = explode(",",$sep);
        foreach($larray2 as $resp)
        {
           $lrut = $resp;
           $ldatos = proposal::select('proposals.*','gestion.gestion as gt','tipificacion.ntipif as tp')
           ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
           ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')           
           ->where('rel','AS') 
           ->where('rutcar',$lrut)
        //    ->where('is_del',false) 
           ->where('borrado','0')                            
           ->get(); 
           $propuestas [] = $ldatos;              
        } 
        $pdf = PDF::loadview('Reportes.updatepdf',['propuestas'=>$propuestas],['officialDate'=>$officialDate]); 
        $pdf->setpaper('a4','landscape');            
        return $pdf->stream("duplicidad.pdf",array("Attachment" => 0));

    }   
    
    public function edit(proposal $proposal, $ldid)   // EDICION DE PROPUESTAS
    {
      
        $ult = Period::where('is_act',true)->first();

        $mes = $ult->mes;
        $anio = $ult->anio; 
        $titulo = "Edicion de Propuestas";
        $propedit =  proposal::select('proposals.*','gestion.gestion as gt','tipificacion.ntipif as tp','bancos.name as bank','users.name as ejea')
        ->where('proposals.id',$ldid)
        ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
        ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
        ->leftjoin('users','users.id', '=', 'proposals.emp_id')
        ->leftjoin('Bancos','bancos.codban','=','proposals.banco')
        // ->where('is_del',false) 
        ->where('borrado', "0")    
        ->get();  
      
        $ruttitb = $propedit[0]->rutcar;
      
        $lsprop =  $propedit[0]->propuesta;
        $lscargas = proposal::where('ruttit',$ruttitb)
        ->where('propuesta',$lsprop)
        ->wherenotin('rel',['AS'])
        ->where('borrado',"0")        
        ->get(); 
        // dd($lscargas); 
        $Nrocar = count($lscargas); 
        $lscoutn = 0;
        return view('Calidad.editp')
        ->with('titulo',$titulo)
        ->with('ldid',$ldid)
        ->with('propedit',$propedit)
        ->with('Nrocar',$Nrocar)
        ->with('lscargas',$lscargas)
        ->with('lscoutn',$lscoutn);
    }

    /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \App\Models\proposal  $proposal
         * @return \Illuminate\Support\Collection
     */
    public function update(Request $request, proposal $proposal, $Nrocar, $ldid)   /// Grabar edicion de propuestas
    {
        // dd($_POST);
        // Borrar las cargas existentes desde la importacion
        $lkborrar = $_POST['borrar'];
        $array = explode(",", $lkborrar);     
        if($lkborrar == "") {           
        } else {          
            $delecargas = Proposal::wherein('id', $array)        
            ->update([
                'borrado' => "1",
             ]);  
        }
        $lcg = $_POST['addcg'];
        // Grabar las cargas que se agregan desde la pantalla de edicion 
        if($lcg > 0) {
            $lsexist = [];
            for( $y = 1;$y <= 6; $y++){  
                $lbuscar = 'aruta'.$y;
                if(isset($_POST[$lbuscar])) {             
                    array_push($lsexist, $y);
                } else {                
                }
            }    
            $lsasrcyc = count($lsexist);
            // dd($lsasrcyc);         
        
            for( $z = 0;$z <= $lsasrcyc-1; $z++){  
                $lvalor = $lsexist[$z];
                $ltrut = $_POST['aruta'.$lvalor];
                $ltdv = $_POST['adva'.$lvalor];
                $ltpat = $_POST['apata'.$lvalor];
                $ltmat = $_POST['amata'.$lvalor];
                $ltnom = $_POST['anoma'.$lvalor];
                $ltsex = $_POST['asexa'.$lvalor];
                $ltrel = $_POST['arela'.$lvalor];
                $ltfn = $_POST['afnaca'.$lvalor];

                $carga = new Proposal();
                $carga->mov =  '1';
                $carga->poliza =  $_POST['poliza'];
                $carga->numgru =  $_POST['splan'];
                $carga->rutcar =  $ltrut;
                $carga->dvcar  =  $ltdv;
                $carga->ruttit =  $_POST['rutcar'];
                $carga->dvtit  =  $_POST['dvcar'];
                $carga->pat    =  $ltpat;
                $carga->mat    =  $ltmat;
                $carga->nom    =  $ltnom;
                $carga->rel    =  $ltrel;
                $carga->sex    =  $ltsex;
                $carga->fnac = $ltfn;
                $carga->isa    =  $_POST['sisapre'] ?? null;
                $carga->tper   =  'C';
                $carga->tben   =  'D';
                $carga->pct    =  '100';
                $carga->monrta =  '$';
                $carga->renta  =  '0';
                $carga->dir    =  $_POST['dirt'];
                $carga->comunas = $_POST['comuna'];
                $carga->ciudad  = $_POST['ciudad'];
                $carga->email   = $_POST['email'];
                $carga->telf    = $_POST['telf'];
                $carga->uf      = $_POST['uf'];
                $carga->clinica = $_POST['clinica'];
                $carga->llave   = $_POST['llave'];
                $carga->propuesta = $_POST['propuesta'];
                $carga->banco     = $_POST['sbanco'];
                $carga->nrocta    = $_POST['nrocta'];
                $carga->rutter    = $_POST['rutter'];
                $carga->dvter     = $_POST['dvter'];                
                $carga->nombreter = $_POST['nomter'] ?? null;
                $carga->dirter    = 'XX';
                $carga->ciudadter = 'XX';
                $carga->comunater = 'XX';
                $carga->telter    = 'XX';
                $carga->ppago     = '0';
                $carga->pprepa    = '1';
                $carga->totaldep = $_POST['montodep'] ?? null;
                $carga->fechadep = $_POST['fechadep']?? null;
                $carga->fechavta = $_POST['fechavta'];                   
                $carga->ejecutiva = $_POST['ejec'] ?? null;
                $carga->peso = $_POST['peso'] ?? null;
                $carga->estat = $_POST['estat'] ?? null;
                $carga->imc = $_POST['imc'] ?? null;
                $carga->supervisor = $_POST['super'] ?? null;        
                $carga->clinica = $_POST['clinica'] ?? null;     
                $carga->gestion = $_POST['gestion'] ?? null;
                $carga->tipificacion = $_POST['tipif']?? null;
                $carga->subtipif = $_POST['subtipif']?? null;
                $carga->gtcall = $_POST['callgestion'] ?? null; 
                $carga->tpcall = $_POST['calltipif']?? null;
                $carga->borrado = "0";
                
                $carga->save();
             
                //    proposal::insert([  
                //     'mov' =>'1',
                //     'poliza' =>$_POST['poliza'],
                //     'numgru' =>$_POST['splan'],
                //     'ruttit' => $_POST['rutcar'], 
                //     'dvtit' =>$_POST['dvcar'],          
                //     'rutcar' => $ltrut,
                //     'dvcar' => $ltdv,
                //     'pat' => $ltpat,
                //     'mat' =>$ltmat,
                //     'nom' => $ltnom,
                //     'rel' =>$ltrel,
                //     'sex' => $ltsex,
                //     'isa' =>$_POST['sisapre'],
                //     'tper' =>'C',
                //     'tben' =>'D',
                //     'pct' =>'100',
                //     'monrta' =>'$',
                //     'renta' =>'0',
                //     'dir' =>$_POST['dirt'],
                //     'comunas' =>$_POST['comuna'],
                //     'ciudad' =>$_POST['ciudad'],
                //     'email' =>$_POST['email'],
                //     'telf' =>$_POST['telf'],
                //     'uf' =>$_POST['uf'],
                //     'clinica' =>$_POST['clinica'],
                //     'llave' =>$_POST['llave'],
                //     'propuesta' =>$_POST['propuesta'],
                //     'banco' =>$_POST['sbanco'],
                //     'nrocta' =>$_POST['nrocta'],
                //     'rutter' =>$_POST['rutter'],
                //     'dvter' =>$_POST['dvter'],                 
                //     'nombreter' => $_POST['nomter'] ?? null,
                //     'dirter' =>'XX',
                //     'ciudadter' =>'XX',
                //     'comunater' =>'XX',
                //     'telter' =>'XX',
                //     'ppago' =>'0',
                //     'pprepa' =>'1',
                //     'totaldep' => $_POST['montodep'] ?? null,
                //     'fechadep' => $_POST['fechadep']?? null,
                //     'fechavta' => $_POST['fechavta'],
                //     // 'rutsup' => $_POST['25989367'],
                //     'ejecutiva' => $_POST['ejec'] ?? null,
                //     'peso' => $_POST['peso'] ?? null,
                //     'estat' => $_POST['estat'] ?? null,
                //     'imc' => $_POST['imc'] ?? null,
                //     'supervisor' => $_POST['super'] ?? null,        
                //     'clinica' => $_POST['clinica'] ?? null,     
                //     'gestion' => $_POST['gestion'] ?? null,
                //     'tipificacion' => $_POST['tipif']?? null,
                //     'subtipif' => $_POST['subtipif']?? null,
                //     'gtcall' => $_POST['callgestion'] ?? null, 
                //     'tpcall' => $_POST['calltipif']?? null,
                //     'borrado' => "0",

                //     // 'fnac' =>$lfn1
                // ]);
            }
        }
    
        


        if(isset($_POST['is-call'])) {
        $lche = $_POST['is-call'];
            if($lche == 'on') {
                $lrcall = 1;
            } 
        } else{          
                $lrcall = 0;
        }
        // dd($lche);
        // dd($Nrocar);
        // Grabar en fecha de Buena Venta 
        
      
        Proposal::where('id', $ldid)            
        ->update([   
        // movimiento
        'poliza' => $_POST['poliza'],
        'numgru' => $_POST['splan'],         
        'ruttit' => $_POST['rutcar'],
        'dvtit' => $_POST['dvcar'],
        'rutcar' => $_POST['rutcar'],
        'dvcar' => $_POST['dvcar'],        
        'pat' => $_POST['pat'],
        'mat' => $_POST['mat'],
        'nom' => $_POST['nom'],
        'sex' => $_POST['ssexo'] ?? null,
        // fecha de nacimiento
        'isa' => $_POST['sisapre'] ?? null,
        'Obs' => $_POST['pre'] ?? null,        
        'email' => $_POST['email'],
        // relacion 
        'dir' => $_POST['dirt'],
        'comunas' => $_POST['comuna'] ?? null,
        'ciudad' => $_POST['ciudad'] ?? null,
        'telf' => $_POST['telf'],
        'propuesta' => $_POST['propuesta'],
        'banco' => $_POST['sbanco'],
        'nrocta' => $_POST['nrocta'],
        'rutter' => $_POST['rutter'] ?? null,
        'dvter' => $_POST['dvter'] ?? null,
        'nombreter' => $_POST['nomter'] ?? null,
        'totaldep' => $_POST['montodep'] ?? null,
        'fechadep' => $_POST['fechadep']?? null,
        'fechavta' => $_POST['fechavta'],
        // 'rutsup' => $_POST['25989367'],
        'ejecutiva' => $_POST['ejec'] ?? null,
        'llave' => $_POST['llave'],        
        'uf' => $_POST['uf'] ?? null,
        'peso' => $_POST['peso'] ?? null,
        'estat' => $_POST['estat'] ?? null,
        'imc' => $_POST['imc'] ?? null,
        'supervisor' => $_POST['super'] ?? null,        
        'clinica' => $_POST['clinica'] ?? null,     
        'gestion' => $_POST['gestion'] ?? null,
        'tipificacion' => $_POST['tipif']?? null,
        'subtipif' => $_POST['subtipif']?? null,
        'gtcall' => $_POST['callgestion'] ?? null, 
        'tpcall' => $_POST['calltipif']?? null, 
        'Observaciones' => $_POST['observa']?? null,
        'is_call' => $lrcall,
        ]);

         // Actualizar la fecha de Gestion de las cargas 
        $lxruttit = proposal::select('ruttit','propuesta')
        ->where('id', $ldid)
        ->get();
     
        $lgrut = $lxruttit[0]->ruttit;
        $lgprop = $lxruttit[0]->propuesta;

        $ult = Period::where('is_act',true)->first();

        $mes = $ult->mes;
        $anio = $ult->anio; 

        Proposal::where('ruttit', $lgrut)
        ->where('propuesta',$lgprop) 
        ->where('borrado',"0") 
        ->where('mes',$mes) 
        ->where('anio',$anio)          
        ->update([   
            'propuesta' => $_POST['propuesta'],
            'gestion' => $_POST['gestion'] ?? null,
            'tipificacion' => $_POST['tipif']?? null,
            'subtipif' => $_POST['subtipif']?? null,
            'gtcall' => $_POST['callgestion'] ?? null, 
            'tpcall' => $_POST['calltipif']?? null, 
            'Observaciones' => $_POST['observa']?? null,            
        ]);
        // *************************************************
        // Actualizar la fecha de la buena venta titular y cargas 
        $fbv = Carbon::now();
        if($_POST['callgestion']  == 5){
            Proposal::where('ruttit', $lgrut)
            ->where('propuesta',$lgprop) 
            ->where('borrado',"0") 
            ->where('mes',$mes) 
            ->where('anio',$anio)             
            ->update([  
                'fechabv' => $fbv,
            ]);
        }

        $Nrocar = intval($Nrocar);
        // Actualizar las cargas que vienen desde la importacion
        if($Nrocar > 0) {
            for( $X = 1;$X <= 3; $X++){    
                $lidcarg = 'id'.$X; 
                if(isset($_POST[$lidcarg])) {
                    $ruta = "ruta".$X;
                    $dva = 'dva'.$X;
                    $pata = 'pata'.$X;
                    $mata = 'mata'.$X;
                    $noma = 'noma'.$X;
                    $sexa = 'sex'.$X;
                    $rela = 'rel'.$X;
                    $fnaca = 'fnaca'.$X; 
                    $lid = $_POST[$lidcarg];               
                    Proposal::where('id', $lid)        
                    ->update([   
                    // movimiento
                    'rutcar' => $_POST[$ruta],
                    'dvcar' => $_POST[$dva],                 
                    'pat' => $_POST[$pata],
                    'mat' => $_POST[$mata],
                    'nom' => $_POST[$noma],
                    'sex' => $_POST[$sexa],
                    'rel' => $_POST[$rela],
                    // 'fnac' => $_POST[$fnaca],
                    'clinica' => $_POST['clinica'],
                    'gestion' => $_POST['gestion'],
                    'llave' => $_POST['llave'],        
                    'uf' => $_POST['uf'] ?? null,
                    'telf' => $_POST['telf'],
                    'propuesta' => $_POST['propuesta'],
                    'gtcall' => $_POST['callgestion']?? null, 
                    ]);
                }
            }
        }
        Cache::forget('querycall');
        return redirect()->route('editp', [$ldid]);
        

    }

    // Index importacion de PDF 
    public function pdfindex() 
    {
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $lmes = $ult->mes;
        $lanio = $ult->anio;   
        $pdfup = proposal::select('proposals.id','proposals.propuesta',
        'proposals.pat','proposals.mat','proposals.nom','proposals.rutcar','proposals.created_at','proposals.pdfscanner')
        ->where('borrado',"0")
        ->where('mes',$lmes)
        ->where('anio',$lanio)
        ->where('rel',"AS")
        ->orderby('propuesta','ASC')
        ->get();
        $titulo = "Carga de PDF de Propuestas (Scanner)";
        return view('calidad.pdfimport')
        ->with('titulo',$titulo)
        ->with('pdfup',$pdfup);
    }

    public function pdfUP(Request $request)   // Subir los PDF a las Propuestas
    {
        // dd($request);
      $trid = $_POST['propbq'];
        if ($request->hasfile("urlpdf")) {
            $file = $request->file("urlpdf");
            $nombre = "propuesta_".$file->getClientOriginalName();            
            $ruta = public_path("propuestas/".$nombre);
            if($file->guessExtension()=="pdf"){
                copy($file,$ruta);
                Proposal::where('id', $trid)        
                ->update([
                    'pdfscanner' => $nombre,
                 ]);  
            } else {
                dd("NO ES UN PDF");
            }
        }
    }

    public function pdfsee() 
    {
     
        $idprop = $_POST['rutbq'];
     
        $lbquery = proposal::select('proposals.*')
        ->where('id',$idprop)
        ->where('borrado',"0")
        ->where('rel',"AS")
        ->get();
        return response(json_encode($lbquery),200)->header('content-type','text-plain');  
        
    }

     public function destroy(proposal $proposal)  // Index Mantenimiento de base de datos  /borrado
    {
        //
        $lusu = Auth::user()->name; 
        $array = $_POST["checks"];
        $lsmnto =   Proposal::wherein('import_id', $array) 
        ->update([  
        'is_del' => true,
        'borrado'=>'1',
        'auditoria' =>'Borrado por: '. $lusu ]);       
        return back();

    }
 
    public function pdfmail(Request $request,$idx,$lbuscar,$lopcion)  // Formato para envio de informacion a los supervisores
    {          
        // dd($idx);
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        $officialDate = $date->format('d-m-Y H:i:s');        
            $propuestas = proposal::select('proposals.*','bancos.name as bank')         
            ->rightjoin('Bancos','bancos.codban','=','proposals.banco')
            // ->where('rutcar',$lbuscar)
            ->where('proposals.id',$idx)
            // ->where('is_del',false)
            ->get(); 
                   
        $pdf = PDF::loadview('Reportes.mail',['propuestas'=>$propuestas],['officialDate'=>$officialDate]); 
        $pdf->setpaper('half-letter','landscape');  
              
        return $pdf->stream("Mail.pdf",array("Attachment" => 0));
    }

    public function filtrar(request $request)  // Para Filtrar las Coincidencias en la duplicidad
    {
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $periodx = Period::all();
        $last = $periodx->last();       
        if($ult == true) {
            $lmes = $ult->mes;
            $lanio = $ult->anio;
            $period = $lmes.$lanio;
            $patst = 1; 
        } else {
            $lmes = $last->mes;
            $lanio = $last->anio;
            $period = $lmes.$lanio;
            $patst = 0;
        }
        $lkrut = $_POST['rutbq']; 
        
        // dd($_POST);
        $coin = proposal::select('proposals.clinica','proposals.llave','proposals.numgru','proposals.rutcar','proposals.mes','proposals.anio'
        ,'proposals.pat','proposals.mat','proposals.nom','proposals.ejecutiva','proposals.supervisor','proposals.rel','proposals.fechavta',
        'proposals.rutter','gestion.gestion as gt')
         ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')          
        ->where('rutcar',$lkrut)
        ->orwhere('rutter',$lkrut)
        ->where('borrado',"0")
        ->groupby('clinica','llave','numgru','rutcar','mes','anio','pat','mat','nom','ejecutiva','supervisor','rel','fechavta','rutter','gt')
        ->get();      
        return response(json_encode($coin),200)->header('content-type','text-plain');  
    }

    public function borrarc()  // BORRAR LAS CARGAS 
    {
        $lusu = Auth::user()->name; 
        $id = $_POST['borrar'];   
        $note =   Proposal::where('id', $id) 
        ->update([  
        'is_del' => true,
        'borrado' => "1",
        'auditoria' =>'Carga dlte: '. $lusu ]);          
        // $note->delete();
        return response(json_encode($note),200)->header('content-type','text-plain');
    } 

}
