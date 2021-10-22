<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;

use App\Models\Audit;
use App\Models\user;
use App\Models\sponsor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AuditExport;
use App\Exports\SponsorExport;
use App\Exports\EjecutExport;
use App\Exports\ConceptsExport;
use Request;


class Auditcontroller extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {       
        $usuarios = Auth::user();
        $userid = $usuarios->id;;
        $emp_type =   $usuarios->idtype; 
 
        $query = audit::query();
        $query_emp = audit::query();
        $ltspon = sponsor::where('is_act',1)->get();
        $ltcount = $ltspon->count();   
     
         // Vertifico los Sponsor activos y verifico si hay auditorias 
        foreach($ltspon as $key => $value){           
            
            if($key == 0 ) {       
                
                $query_emp->where("emp_id","=",$userid)
                ->where("sponsor",$value->id)
                ->where("audits.mes",$value->mes); 

                $query = $query->where("sponsor",$value->id)
                ->where("audits.mes",$value->mes);  
              
            } else {           

                $query_emp->orwhere("emp_id","=",$userid)
                ->where("sponsor",$value->id)
                ->where("audits.mes",$value->mes);

                $query = $query->orwhere("sponsor",$value->id)
                ->where("audits.mes",$value->mes);  
                  
            } 
        }
       
        if($emp_type == 6  OR  $emp_type == 7) {
            if($emp_type == 6){
                $auditadas = $query_emp->select('audits.*','sponsors.name as sname','teleoperadores.name as nombre')          
                ->join('sponsors','sponsors.id', '=', 'audits.sponsor') 
                ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')               
                ->orderby('id','DESC')
                ->get();  

                // dd($auditadas);
            } else {
                $auditadas = $query->select('audits.*','sponsors.name as sname','users.name as name','teleoperadores.name as nombre')             
                ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor')
                ->leftjoin('users','users.id', '=', 'audits.emp_id')
                ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')
                ->orderby('id','DESC')
                ->get();  
                
                
            }
        }       
    
        $auditCount = $auditadas->count();
        // dd($auditCount);
        $cumple =  $auditadas->where('Estado',"CUMPLE")->count();
        $alerta =  $auditadas->where('Estado',"ALERTA")->count();


        return view('Auditorias.Audit')
        ->with('auditadas',$auditadas)
        ->with('auditCount',$auditCount)
        ->with('cumple',$cumple)
        ->with('alerta',$alerta)
        ->with('emp_type',$emp_type);

        
    }

    

    public function combos() {       // Operadores      
        $lsid = $_POST['id'];
        $query =  \DB::table('teleoperadores')
        ->wherein('canalid',[$lsid,99])       
        ->get();
        $data = [];
        foreach($query as $query) {
            $data[] = [
                'id' =>$query->id,
                'name' =>$query->name
            ];
        }
        return $data;     
    }

    public function create()
    {
        $sponsor = sponsor::where('is_act',1)->get();
        $ltcount = $sponsor->count(); 
        
        $campanias =  \DB::table('campanias')
        ->get();
        $teleop =  \DB::table('teleoperadores')
        ->orderby('name','ASC')
        ->get();
        $ejecutivos = auth::user()->get();

        $canal = \DB::table('canal')->get();        
     
        $usuarios = Auth::user();
        $userid = $usuarios->id;;
        $emp_type =   $usuarios->idtype;

       
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();  
        $titulo = "Auditorias";
        return view('Auditorias.ingreso')
        ->with('sponsor',$sponsor)
        ->with('teleop',$teleop)
        ->with('campanias',$campanias)        
        ->with('date',$date)
        ->with('emp_type',$emp_type)
        ->with('usuarios',$usuarios)
        ->with('ejecutivos',$ejecutivos)
        ->with('canal',$canal);
       
    }

    public function grabaudi () {     

        if(isset($_POST['chkasig']) ){
            if($_POST['chkasig'] == 1 ) {
                $userid = $_POST['asigna'];
            } 
        }else {
            $userid = Auth::user()->id;
        }
        $lsponsor = $_POST['sponsor'];
        $ldsp = Sponsor::where('id',$lsponsor)->first(); 
        $ldsd =  Sponsor::where('id',$lsponsor)->count(); ;
        if($ldsd > 0) {          
            $mes = $ldsp->mes; 
            $anio = $ldsp->anio;            
            $datevta = $_POST['fventa'];          
            $dateasi = $_POST['fasig'];                 
            $lfventa = Carbon::createFromFormat('m/d/Y', $datevta)->format('Y/m/d H:i:s');
            $lfasig = Carbon::createFromFormat('m/d/Y', $dateasi)->format('Y/m/d H:i:s'); 
        }
        // Preguntas    
        // (A) - 5
            if(isset($_POST['chkA1'])) {
                $lA1 = $_POST['chkA1'];   // 2%
            } else {
                $lA1 = 0;
            }
            if(isset($_POST['chkA2'])) {
                $lA2 = $_POST['chkA2'];  // 2%
            } else {
                $lA2 = 0;
            }
            if(isset($_POST['chkA3'])) {
                $lA3 = $_POST['chkA3']; // 2%
            } else {
                $lA3 = 0;
            }
            if(isset($_POST['chkA4'])) {
                $lA4 = $_POST['chkA4']; // 2%
            } else {
                $lA4 = 0;
            }
            if(isset($_POST['chkA5'])) {
                $lA5 = $_POST['chkA5']; // 2%
            } else {
                $lA5 = 0;
            }       
        // (B) - 4
            if(isset($_POST['chkB1'])) {
                $lB1 = $_POST['chkB1'];
            } else {
                $lB1 = 0;
            }
            if(isset($_POST['chkB2'])) {
                $lB2 = $_POST['chkB2'];
            } else {
                $lB2 = 0;
            }
            if(isset($_POST['chkB3'])) {
                $lB3 = $_POST['chkB3'];
            } else {
                $lB3 = 0;
            }
            if(isset($_POST['chkB4'])) {
                $lB4 = $_POST['chkB4'];
            } else {
                $lB4 = 0;
            }
           
        // (C) - 6
            if(isset($_POST['chkC1'])) {
                $lC1 = $_POST['chkC1'];
            } else {
                $lC1 = 0;
            }
            if(isset($_POST['chkC2'])) {
                $lC2 = $_POST['chkC2'];
            } else {
                $lC2 = 0;
            }
            if(isset($_POST['chkC3'])) {
                $lC3 = $_POST['chkC3'];
            } else {
                $lC3 = 0;
            }
            if(isset($_POST['chkC4'])) {
                $lC4 = $_POST['chkC4'];
            } else {
                $lC4 = 0;
            }
            if(isset($_POST['chkC5'])) {
                $lC5 = $_POST['chkC5'];
            } else {
                $lC5 = 0;
            } 
            if(isset($_POST['chkC6'])) {
                $lC6 = $_POST['chkC6'];
            } else {
                $lC6 = 0;
            }      
        // (D) - 8
            if(isset($_POST['chkD1'])) {
                $lD1 = $_POST['chkD1'];
            } else {
                $lD1 = 0;
            }
            if(isset($_POST['chkD2'])) {
                $lD2 = $_POST['chkD2'];
            } else {
                $lD2 = 0;
            }
            if(isset($_POST['chkD3'])) {
                $lD3 = $_POST['chkD3'];
            } else {
                $lD3 = 0;
            }
            if(isset($_POST['chkD4'])) {
                $lD4 = $_POST['chkD4'];
            } else {
                $lD4 = 0;
            }
            if(isset($_POST['chkD5'])) {
                $lD5 = $_POST['chkD5'];
            } else {
                $lD5 = 0;
            } 
            if(isset($_POST['chkD6'])) {
                $lD6 = $_POST['chkD6'];
            } else {
                $lD6 = 0;
            }     
            if(isset($_POST['chkD7'])) {
                $lD7 = $_POST['chkD7'];
            } else {
                $lD7 = 0;
            } 
            if(isset($_POST['chkD8'])) {
                $lD8 = $_POST['chkD8'];
            } else {
                $lD8 = 0;
            }        
       
        // (E) - 4 
            if(isset($_POST['chkE1'])) {
                $lE1 = $_POST['chkE1'];
            } else {
                $lE1 = 0;
            }
            if(isset($_POST['chkE2'])) {
                $lE2 = $_POST['chkE2'];
            } else {
                $lE2 = 0;
            }
            if(isset($_POST['chkE3'])) {
                $lE3 = $_POST['chkE3'];
            } else {
                $lE3 = 0;
            }
            if(isset($_POST['chkE4'])) {
                $lE4 = $_POST['chkE4'];
            } else {
                $lE4 = 0;
            }            
        // (F) - 3
            if(isset($_POST['chkF1'])) {
                $lF1 = $_POST['chkF1'];
            } else {
                $lF1 = 0;
            }
            if(isset($_POST['chkF2'])) {
                $lF2 = $_POST['chkF2'];
            } else {
                $lF2 = 0;
            }
            if(isset($_POST['chkF3'])) {
                $lF3 = $_POST['chkF3'];
            } else {
                $lF3 = 0;
            }            
        // (G) - 5
            if(isset($_POST['chkG1'])) {
                $lG1 = $_POST['chkG1'];
            } else {
                $lG1 = 0;
            }
            if(isset($_POST['chkG2'])) {
                $lG2 = $_POST['chkG2'];
            } else {
                $lG2 = 0;
            }
            if(isset($_POST['chkG3'])) {
                $lG3 = $_POST['chkG3'];
            } else {
                $lG3 = 0;
            }
            if(isset($_POST['chkG4'])) {
                $lG4 = $_POST['chkG4'];
            } else {
                $lG4 = 0;
            }
            if(isset($_POST['chkG5'])) {
                $lG5 = $_POST['chkG5'];
            } else {
                $lG5 = 0;
            }              
        // (H) - 7
            if(isset($_POST['chkH1'])) {
                $lH1 = $_POST['chkH1'];
            } else {
                $lH1 = 0;
            }
            if(isset($_POST['chkH2'])) {
                $lH2 = $_POST['chkH2'];
            } else {
                $lH2 = 0;
            }
            if(isset($_POST['chkH3'])) {
                $lH3 = $_POST['chkH3'];
            } else {
                $lH3 = 0;
            }
            if(isset($_POST['chkH4'])) {
                $lH4 = $_POST['chkH4'];
            } else {
                $lH4 = 0;
            }
            if(isset($_POST['chkH5'])) {
                $lH5 = $_POST['chkH5'];
            } else {
                $lH5 = 0;
            } 
            if(isset($_POST['chkH6'])) {
                $lH6 = $_POST['chkH6'];
            } else {
                $lH6 = 0;
            }     
            if(isset($_POST['chkH7'])) {
                $lH7 = $_POST['chkH7'];
            } else {
                $lH7 = 0;
            }       
        
            $audit = new audit;
            $audit->sponsor = $_POST['sponsor'];  
            $audit->sponame = $_POST['hisuper'];           
            $audit->idcia =  $_POST['cia'];
            $audit->campania =  $_POST['hicia'];
            $audit->idoper =  $_POST['telop'];
            $audit->idcanal =  $_POST['canal'];
            $audit->canal =  $_POST['hicanal'];
            $audit->opereva =  $_POST['hioper'];
            $audit->idgrab =  $_POST['idgrab'];
            $audit->rutcli =  $_POST['rutcar'];
            $audit->dvcli =  $_POST['dvcar'];
            $audit->fvta =  $lfventa;
            $audit->fgrab =  $lfasig;
            $audit->idgrab =  $_POST['idgrab'];
            $audit->rutcli =  $_POST['rutcar'];
            $audit->dvcli =  $_POST['dvcar'];      
            // A 
            $audit->PrgA = $_POST['pA'];
            $audit->PrgA1 = $lA1;
            $audit->PrgA2 = $lA2;
            $audit->PrgA3 = $lA3;
            $audit->PrgA4 = $lA4;
            $audit->PrgA5 = $lA5;
            // B 
            $audit->PrgB = $_POST['pB'];
            $audit->PrgB1 = $lB1;
            $audit->PrgB2 = $lB2;
            $audit->PrgB3 = $lB3;
            $audit->PrgB4 = $lB4;
            // C 
            $audit->PrgC = $_POST['pC'];     
            $audit->PrgC1 = $lC1;
            $audit->PrgC2 = $lC2;
            $audit->PrgC3 = $lC3;
            $audit->PrgC4 = $lC4;
            $audit->PrgC5 = $lC5;
            $audit->PrgC6 = $lC6;
            // D 
            $audit->PrgD  = $_POST['pD'];
            $audit->PrgD1 = $lD1;
            $audit->PrgD2 = $lD2;
            $audit->PrgD3 = $lD3;
            $audit->PrgD4 = $lD4;
            $audit->PrgD5 = $lD5;
            $audit->PrgD6 = $lD6;
            $audit->PrgD7 = $lD7;
            $audit->PrgD8 = $lD8;
            // E 
            $audit->PrgE  = $_POST['pE'];
            $audit->PrgE1 = $lE1;
            $audit->PrgE2 = $lE2;
            $audit->PrgE3 = $lE3;
            $audit->PrgE4 = $lE4;
            // F 
            $audit->PrgF  = $_POST['pF'];
            $audit->PrgF1 = $lF1;
            $audit->PrgF2 = $lF2;
            $audit->PrgF3 = $lF3;
            // G 
            $audit->PrgG  = $_POST['pG'];
            $audit->PrgG1 = $lG1;
            $audit->PrgG2 = $lG2;
            $audit->PrgG3 = $lG3;
            $audit->PrgG4 = $lG4;
            $audit->PrgG5 = $lG5;
            // H 
            $audit->PrgH1 = $lH1;
            $audit->PrgH2 = $lH2;
            $audit->PrgH3 = $lH3;
            $audit->PrgH4 = $lH4;
            $audit->PrgH5 = $lH5;
            $audit->PrgH6 = $lH6;
            $audit->PrgH7 = $lH7;  
            $audit->npartial = $_POST['npct'];
            $audit->nfinal = $_POST['ntlt'];
            $audit->estado = $_POST['estado'];
            $audit->emp_id = $userid;
            $audit->mes = $mes;
            $audit->anio =$anio;
            $audit->observ = $_POST['observ'];
            $audit->save();

        return redirect()->route('ingresoAudit');
    }


    public function destroy() {   
        $id = $_POST['id'];
        $usuarios = Auth::user();
        $userid = $usuarios->id;
        $reg = audit::find($id);      
        $reg->auditreg =  $userid;  
        $reg->save();     
        $reg->delete();        
        return response()->json([
            'message' => 'Articulo Eliminado'
        ]); 
    }

    public function export(Request $request) {       
        $usuarios = Auth::user();
        $userid = $usuarios->id;;
        $emp_type =   $usuarios->idtype; 
        $username = $usuarios->name;

        $query = audit::query();
        $query_emp = audit::query();
        $ltspon = sponsor::where('is_act',1)->get();
        $ltcount = $ltspon->count();   
     
         // Vertifico los Sponsor activos y verifico si hay auditorias 
        foreach($ltspon as $key => $value){           
            
            if($key == 0 ) {       
                
                $query_emp->where("emp_id","=",$userid)
                ->where("sponsor",$value->id)
                ->where("audits.mes",$value->mes); 

                $query = $query->where("sponsor",$value->id)
                ->where("audits.mes",$value->mes);  
              
            } else {           

                $query_emp->orwhere("emp_id","=",$userid)
                ->where("sponsor",$value->id)
                ->where("audits.mes",$value->mes);

                $query = $query->orwhere("sponsor",$value->id)
                ->where("audits.mes",$value->mes);  
                  
            } 
        }

        if($emp_type == 6  OR  $emp_type == 7) {
            if($emp_type == 6){
                $auditadas = $query_emp->select('audits.id','sponsors.name as sname','audits.canal as canal',
                'audits.campania','audits.rutcli','audits.fvta','teleoperadores.name as nombre','audits.idGrab','users.name',
                'audits.Fgrab',
                'audits.PrgA','audits.PrgA1','audits.PrgA2','audits.PrgA3','audits.PrgA4','audits.PrgA5',
                'audits.PrgB','audits.PrgB1','audits.PrgB2','audits.PrgB3','audits.PrgB4',
                'audits.PrgC','audits.PrgC1','audits.PrgC2','audits.PrgC3','audits.PrgC4','audits.PrgC5','audits.PrgC6',
                'audits.PrgD','audits.PrgD1','audits.PrgD2','audits.PrgD3','audits.PrgD4','audits.PrgD5','audits.PrgD6','audits.PrgD7','audits.PrgD8',
                'audits.PrgE','audits.PrgE1','audits.PrgE2','audits.PrgE3','audits.PrgE4',
                'audits.PrgF','audits.PrgF1','audits.PrgF2','audits.PrgF3',
                'audits.PrgG','audits.PrgG1','audits.PrgG2','audits.PrgG3','audits.PrgG4','audits.PrgG5',
                'audits.npartial',
                'audits.PrgH1','audits.PrgH2','audits.PrgH3','audits.PrgH4','audits.PrgH5','audits.PrgH6','audits.PrgH7',
                'audits.nfinal','audits.Estado','audits.observ','audits.mes','audits.anio')            
                ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor') 
                ->leftjoin('users','users.id', '=', 'audits.emp_id') 
                ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')   
                ->orderby('id','DESC')    
                ->get();
            } else {
                $auditadas = $query->select('audits.id','sponsors.name as sname','audits.canal as canal',
                'audits.campania','audits.rutcli','audits.fvta','teleoperadores.name as nombre','audits.idGrab','users.name',
                'audits.Fgrab',
                'audits.PrgA','audits.PrgA1','audits.PrgA2','audits.PrgA3','audits.PrgA4','audits.PrgA5',
                'audits.PrgB','audits.PrgB1','audits.PrgB2','audits.PrgB3','audits.PrgB4',
                'audits.PrgC','audits.PrgC1','audits.PrgC2','audits.PrgC3','audits.PrgC4','audits.PrgC5','audits.PrgC6',
                'audits.PrgD','audits.PrgD1','audits.PrgD2','audits.PrgD3','audits.PrgD4','audits.PrgD5','audits.PrgD6','audits.PrgD7','audits.PrgD8',
                'audits.PrgE','audits.PrgE1','audits.PrgE2','audits.PrgE3','audits.PrgE4',
                'audits.PrgF','audits.PrgF1','audits.PrgF2','audits.PrgF3',
                'audits.PrgG','audits.PrgG1','audits.PrgG2','audits.PrgG3','audits.PrgG4','audits.PrgG5',
                'audits.npartial',
                'audits.PrgH1','audits.PrgH2','audits.PrgH3','audits.PrgH4','audits.PrgH5','audits.PrgH6','audits.PrgH7',
                'audits.nfinal','audits.Estado','audits.observ','audits.mes','audits.anio')              
                ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor') 
                ->leftjoin('users','users.id', '=', 'audits.emp_id')  
                ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')  
                ->orderby('id','DESC')    
                ->get();
            }
        }
        $lname = 'Audits-'.$username.'-'.'.xlsx';        
        return Excel::download(new AuditExport($auditadas), $lname);
    }

    public function RepSindex() {
        $sponsor =  \DB::table('sponsors')
        ->get();
        $canal =  \DB::table('canal')
        ->get();
        $cia =  \DB::table('campanias')
        ->get();
        $titulo = "Reporte x Sponsor";
        return view('Auditorias.reportes.indexSponsor')
        ->with('titulo',$titulo)
        ->with('sponsor',$sponsor)
        ->with('canal',$canal)
        ->with('cia',$cia);
    }

    public function repsponsor() {     
        $query = audit::query();             
        $a = $_POST['sponsor']; 
        if (!empty($a)) {
            $query->where("sponsor",$a);
        }        
        $b = $_POST['canal']; 
        if (!empty($b)) {
            $query->where("idcanal",$b);
        }
        $c = $_POST['cia']; 
        if (!empty($c)) {
            $query->where("idcia",$c);
        }  
        
        $d = $_POST['anio']; 
        if (!empty($d)) {
            $query->where("audits.anio",$d);
        }
        $e = $_POST['mes']; 
        if (!empty($e)) {
            $query->where("audits.mes",$e);
        }  

        $sponsor = $query->select('sponsors.name as nombre','audits.canal as canal','campania',\DB::raw('count(*) as cant'),
        \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
        \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'),
        \DB::raw('SUM(npartial) as tparcial'),
        \DB::raw('SUM(nfinal) as tfinal'))                      
        ->join('sponsors','sponsors.id', '=', 'audits.sponsor')
        ->groupby('nombre','campania','canal')
        ->orderby('cant','DESC')
        ->get();

        $spocount = $sponsor->count();   
        $alertas = audit::where('Estado',"ALERTA")->count();
        $cumple = audit::where('Estado',"CUMPLE")->count();
        $total = audit::count();
        if($total > 0) {
        $sumpartial = round(audit::sum('npartial')/$total);     
        $sumfinal = round(audit::sum('nfinal')/$total);
        $cumpli = round(($cumple/$total)*100,2);        
        } else {
            $sumfinal = 0;
            $cumpli = 0;
            $sumpartial = 0;
        }      
        $titulo = "Reporte x Sponsor"; 
         return view('Auditorias.reportes.Sponsor')
         ->with('sponsor',$sponsor)
         ->with('alertas',$alertas)
         ->with('cumple',$cumple)
         ->with('total',$total)
         ->with('sumfinal',$sumfinal)
         ->with('sumpartial',$sumpartial)
         ->with('cumpli',$cumpli)
         ->with('spocount',$spocount)
         ->with('query',$query)
         ->with('a',$a)
         ->with('b',$b)
         ->with('c',$c)
         ->with('titulo',$titulo);      
    }


    public function exportsponsor() {

       $a = $_GET['a'];
       $b = $_GET['b'];
       $c = $_GET['c'];        
        $query = audit::query(); 
        if (!empty($a)) {
            $query->where("sponsor",$a);
        }      
        if (!empty($b)) {
            $query->where("idcanal",$b);
        }    
        if (!empty($c)) {
            $query->where("idcia",$c);
        } 
        $sponsor = $query->select('sponsors.name as nombre','audits.canal as canal','campania',
        \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
        \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'),
        \DB::raw('avg(npartial) as tparcial'),       
        \DB::raw('avg(nfinal) as tfinal'),
        \DB::raw('count(*) as cant'),
        \DB::raw('avg(CASE WHEN Estado ="CUMPLE" THEN 1 ELSE 0 END) AS npcumple'))      
        ->join('sponsors','sponsors.id', '=', 'audits.sponsor')
        ->groupby('nombre','campania','canal')
        ->orderby('cant','DESC')
        ->get();
        $lname = 'Sponsor-'.'.xlsx';        
        return Excel::download(new SponsorExport($sponsor), $lname);
    }

    public function RepEindex() {

        $sponsor =  \DB::table('sponsors')
        ->get();
        $canal =  \DB::table('canal')
        ->get();
        $cia =  \DB::table('campanias')
        ->get();
        $usuarios = user::all();

        $teleop =  \DB::table('teleoperadores')
        ->get();
        $titulo = "Reporte x Ejecutivos";
        return view('Auditorias.reportes.indexejec')
        ->with('titulo',$titulo)
        ->with('sponsor',$sponsor)
        ->with('canal',$canal)
        ->with('cia',$cia)
        ->with('teleop',$teleop)
        ->with('usuarios',$usuarios);

    }

    public function repejecut() {
        $titulo = "Reporte x Ejecutivos";
        $query = audit::query();  
           
        $a = $_POST['sponsor']; 
        if (!empty($a)) {
            $query->where("sponsor",$a);
        }
        
        $b = $_POST['canal']; 
        if (!empty($b)) {
            $query->where("idcanal",$b);
        }

        $c = $_POST['cia']; 
        if (!empty($c)) {
            $query->where("idcia",$c);
        }   
        
        $d = $_POST['oper']; 
        if (!empty($d)) {
            $query->where("idoper",$d);
        }

        $e = $_POST['ejecut']; 
        if (!empty($e)) {
            $query->where("emp_id",$e);
        } 
        
        $f = $_POST['anio']; 
        if (!empty($f)) {
            $query->where("audits.anio",$f);
        }

        $g = $_POST['mes']; 
        if (!empty($g)) {
            $query->where("audits.mes",$g);
        }  

   
        
        $ejecutivos = $query->select('sponsors.name as nombres','canal','campania',
        'teleoperadores.name as nombre','users.name as auditor',
        \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
        \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'),
        \DB::raw('avg(npartial) as tparcial'),
        \DB::raw('avg(nfinal) as tfinal'),
        \DB::raw('count(*) as cant'),
        \DB::raw('avg(CASE WHEN Estado ="CUMPLE" THEN 1 ELSE 0 END) AS npcumple'))                 
        ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')
        ->join('sponsors','sponsors.id', '=', 'audits.sponsor')
        ->join('users','users.id', '=', 'audits.emp_id')
        ->groupby('nombres','canal','campania','nombre','users.name')
        ->orderby('cant','DESC')
        ->get();

        $alertas = audit::where('Estado',"ALERTA")->count();
        $cumple = audit::where('Estado',"CUMPLE")->count();
        $total = audit::count();

        if($total >0 ) {
        $sumpartial = round(audit::sum('npartial')/$total);

        // dd($sumpartial);
        $sumfinal = round(audit::sum('nfinal')/$total);
        $cumpli = round(($cumple/$total)*100,2);
        } else {
            $sumpartial = 0;
            $sumfinal = 0;
            $cumpli = 0;
        }
        return view('Auditorias.reportes.ejecutivos')
        ->with('ejecutivos',$ejecutivos)
        ->with('alertas',$alertas)
        ->with('cumple',$cumple)
        ->with('total',$total)
        ->with('sumfinal',$sumfinal)
        ->with('sumpartial',$sumpartial)
        ->with('cumpli',$cumpli)
        ->with('a',$a)
         ->with('b',$b)
         ->with('c',$c)
         ->with('d',$d)
         ->with('e',$e)
         ->with('titulo',$titulo);
    }

    public function exportejecut() {

        $a = $_GET['a'];
        $b = $_GET['b'];
        $c = $_GET['c'];
        $d = $_GET['d'];
        $e = $_GET['e'];

        $query = audit::query();  
           
     
        if (!empty($a)) {
            $query->where("sponsor",$a);
        }
        
     
        if (!empty($b)) {
            $query->where("idcanal",$b);
        }

      
        if (!empty($c)) {
            $query->where("idcia",$c);
        }   
        
    
        if (!empty($d)) {
            $query->where("idoper",$d);
        }

     
        if (!empty($e)) {
            $query->where("emp_id",$e);
        }   

        $ejecutivos = $query->select('sponsors.name as nombres','canal','campania',
        'teleoperadores.name as nombre',
        \DB::raw('COUNT(CASE WHEN Estado ="ALERTA" THEN Estado END) as alerta'),
        \DB::raw('COUNT(CASE WHEN Estado ="CUMPLE" THEN Estado END) as cumple'),
        \DB::raw('avg(npartial) as tparcial'),
        \DB::raw('avg(nfinal) as tfinal'),
        \DB::raw('count(*) as cant'),
        \DB::raw('avg(CASE WHEN Estado ="CUMPLE" THEN 1 ELSE 0 END) AS npcumple'),
        'users.name as auditor')                 
        ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')
        ->join('sponsors','sponsors.id', '=', 'audits.sponsor')
        ->join('users','users.id', '=', 'audits.emp_id')
        ->groupby('nombres','canal','campania','nombre','users.name')
        ->orderby('cant','DESC')
        ->get();

        $lname = 'Ejecut-'.'.xlsx';        
        return Excel::download(new EjecutExport($ejecutivos), $lname);

       
    }

  

    public function repCindex() {
         $sponsor = sponsor::get();

        $canal =  \DB::table('canal')
        ->get();
        $cia =  \DB::table('campanias')
        ->get();
        $usuarios = user::all();
        $teleop =  \DB::table('teleoperadores')
        ->get();
        $titulo = "Reporte por Conceptos";
        return view('Auditorias.Reportes.indexconcep')
        ->with('titulo',$titulo)
        ->with('sponsor',$sponsor)
        ->with('canal',$canal)
        ->with('cia',$cia)
        ->with('teleop',$teleop)
        ->with('usuarios',$usuarios);

    }

    public function resultcpt() {       

        // dd($_POST['fdesde']);    
        $query = audit::query(); 

        if(isset( $_POST['anio'])) {
            $lanio = $_POST['anio'];
            $query->where("audits.anio",$lanio);            
        }
        if(isset($_POST['mes'])) {
            $lmes = $_POST['mes'];
            $query->where("audits.mes",$lmes);
        }
        if($_POST['fdesde'] !== '') {
            $lfdesde = $_POST['fdesde'];
            $fechad = date('Y-m-d', strtotime($lfdesde));
            // dd($fecha);
            $query->wheredate("audits.created_at",">=",$fechad);
        }
        if($_POST['fhasta'] !== '') {
            $lfhasta = $_POST['fhasta'];
            $fechah = date('Y-m-d', strtotime($lfhasta));
            $query->wheredate("audits.created_at","<=",$fechah);
        }
        if(isset($_POST['sponsor'])) {
            $lsponsor = $_POST['sponsor'];
            $query->where("sponsor",$lsponsor);
        }
        if(isset($_POST['cia'])) {
            $lcia = $_POST['cia'];
            $query->where("idcia",$lcia);
        }
        if(isset($_POST['canal'])) {
            $lcanal = $_POST['canal'];
            $query->where("idcanal",$lcanal);
        }
        if(isset($_POST['oper'])) {
            $loper = $_POST['oper'];
            $query->where("idoper",$loper);
        }
        if(isset($_POST['ejecut'])) {
            $lejec = $_POST['ejecut'];
            $query->where("emp_id",$lejec);
        }
        if(isset($_POST['estado'])) {             
            $lestado = $_POST['estado'];
            $query->where("estado",$lestado);
        }

    

        $titulo = 'Generador de Reportes (Excel)';

        $conceptos = $query->select('audits.id','sponsors.name as sname','audits.canal as canal',
        'audits.campania','audits.rutcli','audits.fvta','teleoperadores.name as nombre','audits.idGrab','users.name',
        'audits.Fgrab',
        'audits.PrgA','audits.PrgA1','audits.PrgA2','audits.PrgA3','audits.PrgA4','audits.PrgA5',
        'audits.PrgB','audits.PrgB1','audits.PrgB2','audits.PrgB3','audits.PrgB4',
        'audits.PrgC','audits.PrgC1','audits.PrgC2','audits.PrgC3','audits.PrgC4','audits.PrgC5','audits.PrgC6',
        'audits.PrgD','audits.PrgD1','audits.PrgD2','audits.PrgD3','audits.PrgD4','audits.PrgD5','audits.PrgD6','audits.PrgD7','audits.PrgD8',
        'audits.PrgE','audits.PrgE1','audits.PrgE2','audits.PrgE3','audits.PrgE4',
        'audits.PrgF','audits.PrgF1','audits.PrgF2','audits.PrgF3',
        'audits.PrgG','audits.PrgG1','audits.PrgG2','audits.PrgG3','audits.PrgG4','audits.PrgG5',
        'audits.npartial',
        'audits.PrgH1','audits.PrgH2','audits.PrgH3','audits.PrgH4','audits.PrgH5','audits.PrgH6','audits.PrgH7',
        'audits.nfinal','audits.Estado','audits.observ','audits.mes','audits.anio')              
        ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor') 
        ->leftjoin('users','users.id', '=', 'audits.emp_id')  
        ->join('teleoperadores','teleoperadores.id', '=', 'audits.idoper')  
        ->orderby('id','DESC')    
        ->get();



        // $conceptos = $query->select('audits.*')->get();
        $concepCount = $conceptos->count();
        
        // dd($conceptos);
        

        $lname = 'Conceptos-'.'.xlsx';        
        return Excel::download(new ConceptsExport($conceptos), $lname);
       
    }

    public function reportday() {

    }


}

