<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\proposal;
use App\Models\sponsor;
use App\Models\period;
use Illuminate\Support\Arr;
use App\Models\Audit;
use Carbon\Carbon;

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
        $today = Carbon::today();   

        $querytop = audit::query(); 
        $query_emp = audit::query(); 
        $query = audit::query(); 
     
        $ltspon = sponsor::where('is_act',1)->get();
        $ltcount = $ltspon->count();    
         // Vertifico los Sponsor activos y verifico si hay auditorias 
            foreach($ltspon as $key => $value){             
            
                if($key == 0 ) {
                    $querytop =  $querytop->where('Estado',"ALERTA")
                    ->where("sponsor",$value->id)
                    ->where("audits.mes",$value->mes);   
                    
                    $query_emp->where("emp_id","=",$emp_idu)
                    ->where("sponsor",$value->id)
                    ->where("audits.mes",$value->mes);  

                    $query = $query->where("sponsor",$value->id)
                    ->where("audits.mes",$value->mes);   
                } else {
                    $querytop =  $querytop->orwhere('Estado',"ALERTA")
                    ->where("sponsor",$value->id)
                    ->where("audits.mes",$value->mes); 

                    $query_emp->orwhere("emp_id","=",$emp_idu)
                    ->where("sponsor",$value->id)
                    ->where("audits.mes",$value->mes);

                    $query = $query->orwhere("sponsor",$value->id)
                    ->where("audits.mes",$value->mes);      
                }       
            }  
        // AUDITORIAS
            // variables de Auditoria    
            $lcounta = 0;
            $lsalertas = 0;
            $lscumple = 0;
            $infograb = []; 
            $infograb2 = []; 
            $ltop =  '';
            $ejecutivos = '';
            $dashsponsor = '';
            $dashcount  = 0;
            $ltopcount  = 0; 
            $ejeccount = 0;
            if($emp_type == 6 OR  $emp_type == 7) {
                if($emp_type == 6){
                    $auditorias = $query_emp->get();
                } else {
                    $auditorias = $query->get();
                    $ltop = $querytop->select('sponsors.name as sponsor','canal',
                    'campanias.name as cia',\DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'))               
                    ->join('sponsors','sponsors.id','=','audits.sponsor')
                    ->join('campanias','campanias.id','=','audits.idcia')
                    ->groupby('sponsors.name','canal','cia')
                    ->get();

                    // dd($ltop);
                    $ltopcount = $ltop->count();

                    $dashsponsor = $query->select('sponame','canal',\DB::raw('count(*) as cant'),
                    \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
                    \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'))  
                    ->groupby('sponame','canal')
                    ->get();
                    $dashcount = $dashsponsor->count();
                }
                    $lcounta = $auditorias->count();
                    $pctpartial = $auditorias->avg('npartial');
                    $pctfinal = $auditorias->avg('nfinal');
                    $infograb2 = [$pctpartial];
                    $name = [];
                    $alt = [];
                    $cum = [];

                    if($lcounta  >0) {
                        $lsalertas = $auditorias->where('Estado','ALERTA')->count();
                        $lscumple = $auditorias->where('Estado','CUMPLE')->count();    
                        
                        $lsgraf = $query->select('sponsors.name as sponsor','canal',\DB::raw('count(*) as cant'),
                        \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
                        \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'))
                        ->join('sponsors','sponsors.id','=','audits.sponsor')  
                        ->groupby('sponsors.name','canal')->get();

                        
                        for($i = 0, $size = count($lsgraf); $i < $size; ++$i) {
                            array_push($name,$lsgraf[$i]['sponsor'].'-'.$lsgraf[$i]['canal']);
                            array_push($alt,$lsgraf[$i]['alerta']);
                            array_push($cum,$lsgraf[$i]['cumple']);
                        }

                        $ejecutivos = audit::select('users.name as ejec',\DB::raw('count(*) as cant'),
                        \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
                        \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'))
                        ->wheredate('audits.created_at',$today)            
                        ->join('users','users.id', '=', 'audits.emp_id')
                        ->groupby('ejec')
                        ->get();
                        $ejeccount = $ejecutivos->count();

                        $lporcumple = round(($lscumple/$lcounta)*100);           
                        $lporalerta = round(($lsalertas/$lcounta)*100); 
                        array_push($infograb2,$pctfinal,$lporcumple);
                        $infograb = [$lsalertas];                           
                        array_push($infograb,$lscumple,$lcounta);          
                    }                
                    return view('home2')
                    ->with('lcounta',$lcounta)
                    ->with('titulo',$titulo)
                    ->with('lsalertas', $lsalertas)
                    ->with('lscumple',$lscumple)
                    ->with('infograb', $infograb)
                    ->with('infograb2', $infograb2)
                    ->with('ejecutivos',$ejecutivos)
                    ->with('emp_type',$emp_type)
                    ->with('ltop',$ltop)
                    ->with('dashsponsor',$dashsponsor)
                    ->with('dashcount',$dashcount)
                    ->with('name',$name)
                    ->with('alt',$alt)
                    ->with('cum',$cum)
                    ->with('ltopcount',$ltopcount)
                    ->with('today',$today)
                    ->with('ejeccount',$ejeccount);
               
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
