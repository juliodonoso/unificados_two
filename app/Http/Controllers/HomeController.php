<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\proposal;
use App\Models\period;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
        // variables
        $emp_idu =  Auth::user()->id;      // Id del Usuario logeado      
        $emp_type =  Auth::user()->idtype;  // Tipo de Usuario
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $ul = Period::all();  
        $ultP = $ul->last();  // Ultimo Periodo Abierto   
        $mes = 0;
        $anio = 0;           
        if ($ult !=null) {
            $mes = $ult->mes;
            $anio = $ult->anio;
            // Gestion Auditoria
            // Total Propuestas del Mes ----- De acuerdo a esyo se muestra o no Informacion
            $Propmes = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')
                // ->where('is_del',false)   
                ->where('borrado','0')                                
                ->get(); 
            $PropCount = $Propmes->count();
            if($PropCount>0) {
                // Total dia
                $ldate = date('Y-m-d');
                $Prophoy = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->wheredate('updated_at',$ldate) 
                ->where('emp_id',$emp_idu)
                ->where('rel','AS')
                // ->where('is_del',false) 
                ->where('borrado','0')                  
                ->get(); 
                $Propgt = $Prophoy ->count(); 
                // Total devueltas
                $Propdev = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')
                // ->where('is_del',false)
                ->where('borrado','0') 
             
                ->where('gestion', 2)          
                ->get(); 
                $PropdevCount = $Propdev->count(); 
                // Total buenas ventas 
                $Propbv = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')             
                ->where('gtcall', 5)                
                // ->where('is_del',false)
                ->where('borrado','0')          
                ->get(); 
                $PropbvCount = $Propbv->count();
                // Otras Gestiones
                $Propog = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')
                // ->where('is_del',false)  
                ->where('borrado','0')           
                ->wherenotin('gestion', [1,2])          
                ->get(); 
                $Propotrg = $Propog->count(); 
                // Sin Gestion
                $Propvcs = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS') 
                // ->where('is_del',false)   
                ->where('borrado','0')          
                ->whereNull('gtcall')         
                ->get(); 
                $Proponull = $Propvcs->count(); 
                //No contesta
                $PropNCb = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')
                // ->where('is_del',false) 
                ->where('borrado','0')            
                ->wherein('gtcall', [4,7])          
                ->get();
                // Gestion de LLamadas
                
                $PropNC = $PropNCb->count();
                // Tareas
                $ptareas = proposal::where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS') 
                // ->where('is_del',false)   
                ->where('borrado','0')          
                ->where('is_mail', 1)          
                ->get(); 

                $tareasCount = $ptareas->count();            
                // Array para el Grafico
                // Porcentajes
                $lporbv = round(($PropbvCount/$PropCount)*100);           
                $lpordv = round(($PropdevCount/$PropCount)*100);
       
                $lporot = round(($Propotrg/$PropCount)*100);
                $lpornull = round(($Proponull/$PropCount)*100);          
                $info = [$lporbv];
              
                array_push($info,$lpordv,$lporot,$lpornull);    
                // dd($info);             
                // cumplimiento
                $lcumple = round((($PropCount - $PropNC)/$PropCount)*100);
            //  dd($PropNC);
                $cumpl = $str = (string) $lcumple.'%'; 
                $ldash = 1; 
            } else {
                $PropCount = 0;
                $Propgt = 0;
                $PropdevCount = 0;
                $PropbvCount = 0;
                $ptareas = '';
                $tareasCount = 0;
                $info = [];
                $cumpl = '';
                $ldash = 1;
            }
        } else {
            $PropCount = 0;
            $Propgt = 0;
            $PropdevCount = 0;
            $PropbvCount = 0;
            $ptareas = '';
            $tareasCount = 0;
            $info = [];
            $cumpl = '';
            $ldash = 0;
        }
        $titulo = "Inicio";
        return view('home')
        ->with('titulo',$titulo)
        ->with('PropCount',$PropCount)
        ->with('Propgt',$Propgt)
        ->with('PropdevCount',$PropdevCount)
        ->with('PropbvCount',$PropbvCount)
        ->with('ptareas',$ptareas)
        ->with('tareasCount',$tareasCount)
        ->with('info',$info)
        ->with('cumpl',$cumpl)
        ->with('ldash',$ldash);        
    }

    public function pruebas() 
    {
        $titulo = 'Inicio'; 
        return view('home2')
        ->with('titulo',$titulo);
    }
}
