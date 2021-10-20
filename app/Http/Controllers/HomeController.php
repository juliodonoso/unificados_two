<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\proposal;
use App\Models\period;
use Illuminate\Support\Arr;
use App\Models\Audit;

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
        // variables Generales del home 
        $emp_idu =  Auth::user()->id;      // Id del Usuario logeado      
        $emp_type =  Auth::user()->idtype;  // Tipo de Usuario
        $titulo = "Inicio";         
        // AUDITORIAS
            // variables de Auditoria    
            $lcounta = 0;
            $lsalertas = 0;
            $lscumple = 0;
            $infograb = []; 
            $infograb2 = []; 
            $ltop =  '';
            $ejecutivos = '';
            if($emp_type == 6 OR  $emp_type == 7) {
                if($emp_type == 6){
                $auditorias = audit::where('emp_id',$emp_idu)->get();
                } else {
                $auditorias = audit::all();  
                $ltop = audit::select('sponsors.name as sponsor',
                'campanias.name as cia',\DB::raw('count(*) as cant'))
                ->join('sponsors','sponsors.id','=','audits.sponsor')
                ->join('campanias','campanias.id','=','audits.idcia')
                ->groupby('sponsors.name','cia')
                ->get();

                }
                $lcounta = $auditorias->count();
                $pctpartial = $auditorias->avg('npartial');
                $pctfinal = $auditorias->avg('nfinal');
                $infograb2 = [$pctpartial];
              
                // dd($infograb2);
                if($lcounta  >0) {
                    $lsalertas = $auditorias->where('Estado','ALERTA')->count();
                    $lscumple = $auditorias->where('Estado','CUMPLE')->count();                   
                    $ejecutivos = audit::select('users.name as ejec',\DB::raw('count(*) as cant'),
                    \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
                    \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'))                 
                    ->join('users','users.id', '=', 'audits.emp_id')
                    ->groupby('ejec')
                    ->get();
                    
                   
                    $lporcumple = round(($lscumple/$lcounta)*100);           
                    $lporalerta = round(($lsalertas/$lcounta)*100); 
                    array_push($infograb2,$pctfinal,$lporcumple);
                    $infograb = [$lsalertas];  
                            
                    array_push($infograb,$lscumple,$lcounta);

                }
                // dd($infograb);
                return view('home2')
                ->with('lcounta',$lcounta)
                ->with('titulo',$titulo)
                ->with('lsalertas', $lsalertas)
                ->with('lscumple',$lscumple)
                ->with('infograb', $infograb)
                ->with('infograb2', $infograb2)
                ->with('ejecutivos',$ejecutivos)
                ->with('emp_type',$emp_type)
                ->with('ltop',$ltop); 
            }
          
        // CALIDAD 
            // Variables de Calidad     
            $ult = Period::where('is_act',true)->first();  // Periodo 
            $ul = Period::all();  
            $ultP = $ul->last();  // Ultimo Periodo Abierto   
            $mes = 0;
            $anio = 0;   
            $ldate = date('Y-m-d');       

            if($emp_type >= 1  and  $emp_type <= 4) {
                if ($ult !=null) {
                    $mes = $ult->mes;
                    $anio = $ult->anio;
                    $Propmes = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')              
                    ->where('borrado','0')                                
                    ->get();
                    $PropCount = $Propmes->count();
                    if($PropCount>0) {
                        $Propgestion  = proposal::where('mes',$mes) 
                        ->where('anio',$anio)
                        ->where('rel','AS')              
                        ->where('borrado','0')  
                        ->whereDate('updated_at','=',$ldate)->get();
                        $Propgt  = $Propgestion->count();
                        $PropdevCount  = $Propmes->where('gestion',2)->count();
                        $PropbvCount  = $Propmes->where('gtcall',5)->count();
                        $Propotrg   = $Propmes->wherenotin('gestion',[1,2])->count();
                        $Proponull  = $Propmes->wherenull('gtcall')->count();
                        $PropNC  = $Propmes->wherein('gtcall',[4,7])->count();
                        $tareasCount = $Propmes->where('is_mail',1)->count();
                        $lporbv = round(($PropbvCount/$PropCount)*100);           
                        $lpordv = round(($PropdevCount/$PropCount)*100);
                        $lporot = round(($Propotrg/$PropCount)*100);
                        $lpornull = round(($Proponull/$PropCount)*100);          
                        $info = [$lporbv];              
                        array_push($info,$lpordv,$lporot,$lpornull);
                        $lcumple = round((($PropCount - $PropNC)/$PropCount)*100);
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
                }  else {
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
                return view('home2')
                ->with('PropCount',$PropCount)
                ->with('Propgt',$Propgt)
                ->with('PropdevCount',$PropdevCount)
                ->with('PropbvCount',$PropbvCount)
                // ->with('ptareas',$ptareas)
                ->with('tareasCount',$tareasCount)
                ->with('info',$info)
                ->with('cumpl',$cumpl)
                ->with('ldash',$ldash); 
            }
        // LLAMADAS 
            if($emp_type == 5) {

            }

          
    }

    public function pruebas() 
    {
        $titulo = 'Inicio'; 
        return view('home2')
        ->with('titulo',$titulo);
    }
}
