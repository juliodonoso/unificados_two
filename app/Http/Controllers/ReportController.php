<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\period;
use App\Models\proposal;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\proposalExport;
use App\Exports\MovExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // Reporte de Gestion
    public function index()
    {
        //
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $ul = Period::all();  
        $ultP = $ul->last();  // Ultimo Periodo Abierto   
        $mes = 0;
        $anio = 0;           
        if ($ult !=null) {
            $mes = $ult->mes;
            $anio = $ult->anio;         
            $Propmes = proposal::select('proposals.clinica as clin',
            proposal::raw("COUNT(proposals.llave) as count_nro"))
            // proposal::raw("COUNT(CASE WHEN gestion =  2 THEN 1 ELSE 0 END) AS devol"))   
            ->selectRaw("count(case when gestion = 2 then 1 end) as devol")  
            ->selectRaw("count(case when gtcall = 5 then 1 end) as bv")   
            ->selectRaw("count(case when gestion in(1) then 1 end) as ing")  
            ->selectRaw("count(case when gestion in(1) and gtcall not in (5,8,9) then 1 end) as ingBV")                   
                ->where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')            
                ->where('borrado',"0")                  
                ->groupby('clin')
                ->orderby('clin','DESC')         
                ->get(); 
             
            $total = proposal::where('mes',$mes) 
            ->where('anio',$anio)
            ->where('rel','AS')
            ->where('borrado',"0")
            ->count();

            $totaling = proposal::where('mes',$mes) 
            ->where('anio',$anio)
            ->where('rel','AS')
            ->where('borrado',"0")
            ->where('gestion',1)   
            ->count();

            $NCing = proposal::where('mes',$mes) 
            ->where('anio',$anio)
            ->where('rel','AS')
            ->where('borrado',"0")
            ->where('gestion',1)
            ->where('gtcall','<>',5)   
            ->count();

            $dev = proposal::where('mes',$mes) 
            ->where('anio',$anio)
            ->where('rel','AS')
            ->where('borrado',"0")   
            ->where('gestion',2)
            ->count();

            $bv = proposal::where('mes',$mes) 
            ->where('anio',$anio)
            ->where('rel','AS')
            ->where('borrado',"0")   
            ->where('gtcall',5)
            ->count();

            $pctgt = proposal::where('mes',$mes) 
            ->where('anio',$anio)
            ->where('rel','AS')
            ->where('borrado',"0")   
            ->wherein('gtcall',[5,6,8,9])
            ->count();

            $pcbv = round(($pctgt/$total)*100);
            //  GRAFICO DE BARRAS

                    // RED SALUD
                    $RS  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gtcall',5)
                    ->where('clinica',"RED SALUD")
                    ->count();

                    $RSD  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gestion',2)
                    ->where('clinica',"RED SALUD")
                    ->count();

                    $RST  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")        
                    ->where('clinica',"RED SALUD")
                    ->count();

                    // DAVILA
                    $DV  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gtcall',5)
                    ->where('clinica',"DAVILA")
                    ->count();
        
                    $DVD  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gestion',2)
                    ->where('clinica',"DAVILA")
                    ->count();
        
                    $DVT  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")        
                    ->where('clinica',"DAVILA")
                    ->count();
                    // INDISA
                    $IND  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gtcall',5)
                    ->where('clinica',"INDISA")
                    ->count();
        
                    $INDD  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gestion',2)
                    ->where('clinica',"INDISA")
                    ->count();
        
                    $INDT  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")        
                    ->where('clinica',"INDISA")
                    ->count();
        
                    // STA MARIA 
                    $SM  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gtcall',5)
                    ->where('clinica',"SANTA MARIA")
                    ->count();
        
                    $SMD  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gestion',2)
                    ->where('clinica',"SANTA MARIA")
                    ->count();
        
                    $SMT  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")        
                    ->where('clinica',"SANTA MARIA")
                    ->count();
                    // CONCEPCION
                    $CON = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gtcall',5)
                    ->where('clinica',"CONCEPCION")
                    ->count();
        
                    $COND  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gestion',2)
                    ->where('clinica',"CONCEPCION")
                    ->count();
        
                    $CONT  = proposal::where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")        
                    ->where('clinica',"CONCEPCION")
                    ->count();
            
                    $info = [$DV];
                    array_push($info,$IND,$SM,$RS,$CON); 
                    $info2 = [$DVD];
                    array_push($info2,$INDD,$SMD,$RSD,$COND); 
                    $info3 = [$DVT];
                    array_push($info3,$INDT,$SMT,$RST,$CONT); 
              
            // FIN GRAFICO DE BARRAS

            // UF
                $mesUF = proposal::select('proposals.clinica as clin',
                proposal::raw("COUNT(proposals.llave) as count_nro"),
                proposal::raw("SUM(proposals.uf) as UF"))                                     
                    ->where('mes',$mes) 
                    ->where('anio',$anio)
                    ->where('rel','AS')
                    ->where('borrado',"0")
                    ->where('gestion',1)                    
                    ->groupby('clin')
                    ->orderby('clin','DESC')         
                    ->get(); 
            // FIN UF 

       

            $detalle = proposal::select('gestion.gestion as gt','tipificacion.ntipif as tp',
                proposal::raw("COUNT(proposals.llave) as count_nro"))
                ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
                ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
                ->where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')
                ->where('borrado',"0")             
                ->groupby('gt','tp')
                ->orderby('gt','DESC')         
                ->get(); 


                $detallecall = proposal::select('gestion.gestion as gt',
                proposal::raw("COUNT(proposals.llave) as count_nro"))
                ->leftjoin('gestion','gestion.id', '=', 'proposals.gtcall')              
                ->where('mes',$mes) 
                ->where('anio',$anio)
                ->where('rel','AS')
                ->where('borrado',"0")             
                ->groupby('gt')
                ->orderby('gtcall','DESC')         
                ->get(); 


                // dd($detalle);   
                
                
        } else {

        }
    
        $titulo = "Reporte de Gestion";
        return view('Reportes.calidad.gtreport')
        ->with('titulo',$titulo)
        ->with('Propmes',$Propmes)
        ->with('total',$total)
        ->with('detalle',$detalle)
        ->with('detallecall',$detallecall)
        ->with('mes',$mes)
        ->with('anio',$anio)
        ->with('dev',$dev)
        ->with('bv',$bv)
        ->with('pcbv',$pcbv)
        ->with('info',$info)
        ->with('info2',$info2)
        ->with('info3',$info3)
        ->with('mesUF',$mesUF)
        ->with('totaling',$totaling)
        ->with('NCing',$NCing);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexConcep()
    {
        //
        $categories = \DB::table('clinicas')
        ->get();      
        $titulo = "Reporte por Concepto";
        return view('Reportes.calidad.conceptos')
        ->with('titulo',$titulo)
        ->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function expConcep(Request $request)
    {
        $query = proposal::query();
        if(isset($_POST['chk-clin'])) {
            $a = $_POST['clin']; 
            if (!empty($a)) {
                $query->wherein("proposals.clinica",$a);
            }
        }
        if(isset($_POST['chk-gt'])) {           
            $b= $_POST['gt'];        
            if (!empty($b)) {
                $query->wherein("proposals.gestion", $b);
            }
        }
        if(isset($_POST['chk-tp'])) {
            $c = $_POST['tp']; 
            if (!empty($c)) {
                $query->wherein("proposals.tipificacion", $c);
            }
        }
        ///// nuevo
        if(isset($_POST['chk-stp'])) {
            $d = $_POST['stp']; 
            if (!empty($d)) {
                $query->wherein("proposals.subtipif", $d);
            }
        }
        if(isset($_POST['chk-gtc'])) {
            $e = $_POST['gtc']; 
            if (!empty($e)) {
                $query->wherein("proposals.gtcall", $e);
            }
        }
        if(isset($_POST['chk-tpc'])) {
            $f = $_POST['tpc']; 
            if (!empty($f)) {
                $query->wherein("proposals.tpcall", $f);
            }
        }
        if(isset($_POST['chk-plan'])) {
            $g = $_POST['plan']; 
            if (!empty($g)) {
                $query->wherein("numgru",$g);
            }
        }
        if(isset($_POST['chk-bk'])) {
            $h = $_POST['bk']; 
            if (!empty($h)) {
                $query->wherein("banco", $h);
            }
        }
        if(isset($_POST['chk-man'])) {
            $i = $_POST['man']; 
            if (!empty($i)) {
                $query->where("tipo", $i);
            }
        }
        if(isset($_POST['chk-eje'])) {
            $j = $_POST['eje']; 
            if (!empty($j)) {
                $query->wherein("ejecutivo", $j);
            }
        }
        if(isset($_POST['chk-super'])) {
            $k = $_POST['super']; 
            if (!empty($k)) {
                $query->wherein("supervisor", $k);
            }
        }
        if(isset($_POST['chk-mes'])) {
            $l = $_POST['mes']; 
            if (!empty($l)) {
                $query->wherein("mes", $l);
            }
        }
        if(isset($_POST['chk-anio'])) {
            $m = $_POST['anio']; 
            if (!empty($m)) {
                $query->wherein("anio", $m);
            }
        }
        
        
        // $ls = $query->select('proposals.*','gt1.gestion as gt',
        // 'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
        // 'tp2.ntipif as tipcall','bancos.name as bk' )        
        // ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
        // ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
        // ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
        // ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
        // ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
        // ->leftjoin('bancos','bancos.id', '=', 'proposals.banco')
        // ->where('borrado',"0")        
        // ->get();  
        

        $ls = $query->select('numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
        'sex','fnac','obs','rel','telf','propuesta','banco','nrocta','rutter','dvter','nombreter',
        'fechavta','rutsup','ejecutivo','llave','uf','supervisor','ejecutiva','fechaent','clinica','tipo','origen','clasif',
        'gt1.gestion as gt',
        'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
        'tp2.ntipif as tipcall','bancos.name as bk','observaciones')
        ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
        ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
        ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
        ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
        ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
        ->leftjoin('bancos','bancos.codban', '=', 'proposals.banco')
        // ->where('borrado',"0")
        ->where('borrado','0')      
         
        ->get(); 



        // dd($ls);
        $lname = 'Report.xlsx';
        return Excel::download(new ProposalExport($ls), $lname);

    }

    public function indexdiario()
    {
        $titulo = "Reporte diario x concepto";
        return view('reportes.calidad.diario')
        ->with('titulo',$titulo);
    }
    // Funcion del reporte diario de concepto
    public function dayreport()
    {
        $query = proposal::query();
        if(isset($_POST['clin'])) {
            $clin = $_POST['clin'];
            if(!empty($clin)) {
                $query->where("clinica", $clin);
            }
        }
        if(isset($_POST['gestion'])) {
            $gt = $_POST['gestion'];
            if(!empty($clin)) {
            $query->where("gtcall", $gt);
            }
        }
        if(isset($_POST['tipo'])) {         
            $tip = $_POST['tipo'];
            if(!empty($tip)) {
            $query->where("tipo", $tip);          
            }
        }
         
        $ldate = $_POST['dated'];
        $lsdate = Carbon::createFromFormat('m/d/Y', $ldate)->format('Y-m-d');
        $ldateh = $_POST['dateh'];
        $lsdateh = Carbon::createFromFormat('m/d/Y', $ldateh)->format('Y-m-d');
        

        $lgt = $_POST['gestion'];
        $queryday = $query->select('Mov','Poliza','numgru','RutTit','dvtit','Rutcar','dvcar','Pat','Mat','nom',
        'sex','fnac','isa','obs','email','rel','dir','comunas','ciudad','tper','tben','pct','vdesde',
        'vhasta','telf','monrta','renta','propuesta','banco','nrocta','vigenciatc','diacob','mescob','rutter','dvter','nombreter',
        'dirter','ciudadter','comunater','telter','ppago','pprepa','totaldep','fechadep','fechavta','rutsup','ejecutivo','llave','uf','peso','estat','imc',)
        ->selectRaw('DATE(updated_at) AS Fecha')
        ->wheredate('updated_at','>=', $lsdate)  
        ->wheredate('updated_at','<=', $lsdateh)
        ->where('gtcall',$gt)
        // ->where('borrado',"0")
        ->where('borrado','0')
        ->orderby('poliza','ASC')       
        ->orderby('ruttit','ASC')          
        ->get();   
        $lsnro = count($queryday);   
        $fecha = date("d", strtotime($ldate));    
        $lname = 'Gestion-'.$lgt.'-dia:'.$fecha.'.xlsx';
        if($lsnro > 0) {
        return Excel::download(new MovExport($queryday), $lname);
        return back();
        } else {
            $titulo = "Reporte diario x concepto";
            return view('reportes.calidad.diario')
            ->with('titulo',$titulo)
            ->with('lsnro',$lsnro);
        }
      
    }

    public function txt() 
    {
        $titulo = "Reporte TxT PAT";
        return view('reportes.calidad.txt')
        ->with('titulo',$titulo);
    }

    public function gentxt() 
    {
        return("prueba");
    }
    // Index Supervisor 
    public function superv() 
    {
        $developers=  \DB::table('supmetlife')
        ->select('name','rutsup')        
        ->orderby('name','ASC')
        ->get();
       
        $titulo = "Reporte Supervisores / Ejecutivos";
        return view('Reportes.calidad.supervisor')
        ->with('developers',$developers);
        
    }
      //   Reporte de Supervisor
    public function gensup () 
    {
        $lejecutivos = 0;
        $Propeje = [];
        $lmes = $_POST['mes'];    
        $lanio = $_POST['anio'];    
        if(isset($_POST['super'])) {
            $lejecutivos = 1;
            $lsup = $_POST['super'];
            $Propeje = proposal::select('ejecmetlife.name as nombreeje','proposals.rutsup','proposals.clinica as clinica',
                proposal::raw("COUNT(proposals.llave) as count_nro"),
                proposal::raw("SUM(proposals.uf) as UF"))              
                ->selectRaw("count(case when gestion = 2 then 1 end) as devol")  
                ->selectRaw("count(case when gtcall = 5 then 1 end) as bv")
                ->leftjoin('ejecmetlife','ejecmetlife.ruteje', '=', 'proposals.rutsup')                        
                ->where('mes', $lmes ) 
                ->where('anio',$lanio)
                ->where('rel','AS')
                // ->where('borrado',"0")   
                ->where('borrado',"0")         
                // ->where('gtcall',5) 
                ->where('ejecutivo',$lsup)                    
                ->groupby('nombreeje','rutsup','clinica')
                ->orderby('nombreeje','DESC')         
                ->get(); 
            $Propsup = proposal::select('proposals.ejecutivo as superv',
            proposal::raw("COUNT(proposals.llave) as count_nro"),
                proposal::raw("SUM(proposals.uf) as UF"),
                'supmetlife.name as nombresup','proposals.clinica as clinica')              
                ->selectRaw("count(case when gestion = 2 then 1 end) as devol")  
                ->selectRaw("count(case when gtcall = 5 then 1 end) as bv")
                ->leftjoin('supmetlife','supmetlife.rutsup', '=', 'proposals.ejecutivo')                        
                ->where('mes',$lmes) 
                ->where('anio',$lanio)
                ->where('rel','AS')
                ->where('borrado',"0") 
                // ->where('gtcall',5) 
                ->where('proposals.ejecutivo',$lsup)                    
                ->groupby('superv','nombresup','clinica')
                ->orderby('superv','DESC')         
                ->get();      
        } else {
            $Propsup = proposal::select('proposals.ejecutivo as superv',
            'supmetlife.name as nombresup','proposals.clinica as clinica',
            proposal::raw("COUNT(proposals.llave) as count_nro"),
            proposal::raw("SUM(proposals.uf) as UF"))              
            ->selectRaw("count(case when gestion = 2 then 1 end) as devol")  
            ->selectRaw("count(case when gtcall = 5 then 1 end) as bv")
            ->leftjoin('supmetlife','supmetlife.rutsup', '=', 'proposals.ejecutivo')                        
            ->where('mes',$lmes) 
            ->where('anio',$lanio)
            ->where('rel','AS')
            ->where('borrado',"0") 
            // ->where('gtcall',5)                     
            ->groupby('superv','nombresup','clinica')
            ->orderby('clinica','DESC')         
            ->get();          
        }
        $titulo = "Reporte Supervisores / Ejecutivos";
        return view('Reportes.calidad.gensup')
        ->with('Propsup',$Propsup)
        ->with('lejecutivos',$lejecutivos)
        ->with('Propeje',$Propeje);
    }

    public function devsup ()
    {
        $developers=  \DB::table('supmetlife')
        ->select('name','rutsup')        
        ->orderby('name','ASC')   
        ->get();
        $titulo = "Reporte Devoluciones x Supervisor";
        return view('Reportes.calidad.devsup')
        ->with('developers',$developers);

    }

    public function gendev()
    {
        $Propeje = [];
        $lmes = $_POST['mes']; 
        $lanio = $_POST['anio'];      
   
            $lejecutivos = 1;
            $lsup = $_POST['super'];
            $Propeje = proposal::select('tipificacion.ntipif as tp','ejecmetlife.name as nombreeje',               
                proposal::raw("COUNT(proposals.llave) as count_nro"),
                proposal::raw("SUM(proposals.uf) as UF"))              
                ->leftjoin('ejecmetlife','ejecmetlife.ruteje', '=', 'proposals.rutsup')
                ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
                ->where('mes',$lmes) 
                ->where('anio',$lanio)
                ->where('rel','AS')
                // ->where('borrado',"0")            
                ->where('gestion',2) 
                ->where('ejecutivo',$lsup)  
                ->where('borrado','0')                        
                ->groupby('tp','nombreeje')
                ->orderby('nombreeje','DESC')         
                ->get(); 
                // dd($Propeje);
            $Propsup = proposal::select('proposals.ejecutivo as superv',
                proposal::raw("COUNT(proposals.llave) as count_nro"),
                proposal::raw("SUM(proposals.uf) as UF"),
                'supmetlife.name as nombresup','proposals.clinica as clinica')              
                ->selectRaw("count(case when gestion = 2 then 1 end) as devol")  
                ->selectRaw("count(case when gtcall = 5 then 1 end) as bv")
                ->leftjoin('supmetlife','supmetlife.rutsup', '=', 'proposals.ejecutivo')                        
                ->where('mes',$lmes) 
                ->where('anio',$lanio)
                ->where('rel','AS')
                // ->where('borrado',"0") 
                ->where('borrado','0')  
                ->where('gestion',2) 
                ->where('proposals.ejecutivo',$lsup)                    
                ->groupby('superv','nombresup','clinica')
                ->orderby('superv','DESC')         
                ->get(); 
        $titulo = "Reporte Devoluciones x Supervisor";
        return view('Reportes.calidad.devoluciones')
        ->with('Propsup',$Propsup)
        ->with('lejecutivos',$lejecutivos)
        ->with('Propeje',$Propeje);

    }
 }
