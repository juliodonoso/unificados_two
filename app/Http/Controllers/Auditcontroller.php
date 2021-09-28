<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Audit;
use App\Models\sponsor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Auditcontroller extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {       
        $userid = Auth::user()->id;
        $auditadas = audit::select('audits.*','sponsors.name as sname')
        ->where('emp_id',$userid)
        ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor')
        ->orderby('id','DESC')
        ->paginate(25);        
        $auditCount = $auditadas->count(); 

        $estado = audit::select('Estado',\DB::raw('count(*) as cant'))
        ->where('emp_id',$userid)
        ->groupby('Estado')
        ->orderby('cant','DESC')
        ->get();   
        
        $cumple = audit::where('Estado',"CUMPLE")
        ->where('emp_id',$userid)
        ->count();

        $alerta = audit::where('Estado',"ALERTA")
        ->where('emp_id',$userid)
        ->count();

        return view('Auditorias.Audit')
        ->with('auditadas',$auditadas)
        ->with('auditCount',$auditCount)
        ->with('cumple',$cumple)
        ->with('alerta',$alerta);

        
    }

    public function create()
    {
        $sponsor =  \DB::table('sponsors')
        ->get();
        $campanias =  \DB::table('campanias')
        ->get();
        $teleop =  \DB::table('teleoperadores')
        ->get();     
       
        $carbon = new \Carbon\Carbon();
        $date = $carbon->now();
        // $officialDate = $date->format('d-m-Y H:i:s');
        $titulo = "Auditorias";
        return view('Auditorias.ingreso')
        ->with('sponsor',$sponsor)
        ->with('teleop',$teleop)
        ->with('campanias',$campanias)        
        ->with('date',$date);
       
    }

    public function grabaudi () {   
        // var_dump($_POST);    
        $userid = Auth::user()->id;
        $lsponsor = $_POST['sponsor'];
        $ldsp = Sponsor::where('id',$lsponsor)->first(); 
        $mes = $ldsp->mes; 
        $anio = $ldsp->anio;        
        $lcia = $_POST['cia'];          
        $lteleop = $_POST['telop'];       
        $datevta = $_POST['fventa'];          
        $dateasi = $_POST['fasig'];      
        $lrutcar = $_POST['rutcar'];          
        $ldvcar = $_POST['dvcar'];          
        $lidgrab = $_POST['idgrab'];               
        $lfventa = Carbon::createFromFormat('m/d/Y', $datevta)->format('Y/m/d H:i:s');
        $lfasig = Carbon::createFromFormat('m/d/Y', $dateasi)->format('Y/m/d H:i:s'); 
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
   
     
        audit::insert([  
            'sponsor' => $_POST['sponsor'][0],
            'campania'=> $_POST['cia'][0],
            'opereva'  => $_POST['telop'],
            'idgrab' => $_POST['idgrab'],
            'rutcli' => $_POST['rutcar'],          
            'dvcli' => $_POST['dvcar'],
            'fvta' => $lfventa, 
            'fgrab' => $lfasig, 
            // A 
            'PrgA' => $_POST['pA'],
            'PrgA1' => $lA1,
            'PrgA2' => $lA2,
            'PrgA3' => $lA3,
            'PrgA4' => $lA4,
            'PrgA5' => $lA5,
            // B
            'PrgB' => $_POST['pB'],
            'PrgB1' => $lB1,
            'PrgB2' => $lB2,
            'PrgB3' => $lB3,
            'PrgB4' => $lB4, 
            // C
            'PrgC' => $_POST['pC'],     
            'PrgC1' => $lC1,
            'PrgC2' => $lC2,
            'PrgC3' => $lC3,
            'PrgC4' => $lC4,
            'PrgC5' => $lC5,
            'PrgC6' => $lC6,
            // D 
            'PrgD' => $_POST['pD'],
            'PrgD1' => $lD1,
            'PrgD2' => $lD2,
            'PrgD3' => $lD3,
            'PrgD4' => $lD4,
            'PrgD5' => $lD5,
            'PrgD6' => $lD6,
            'PrgD7' => $lD7,
            'PrgD8' => $lD8,
            // E 
            'PrgE' => $_POST['pE'],
            'PrgE1' => $lE1,
            'PrgE2' => $lE2,
            'PrgE3' => $lE3,
            'PrgE4' => $lE4,
            // F 
            'PrgF' => $_POST['pF'],
            'PrgF1' => $lF1,
            'PrgF2' => $lF2,
            'PrgF3' => $lF3,
            // G 
            'PrgG' => $_POST['pG'],
            'PrgG1' => $lG1,
            'PrgG2' => $lG2,
            'PrgG3' => $lG3,
            'PrgG4' => $lG4,
            'PrgG5' => $lG5,
            // H 
            'PrgH1' => $lH1,
            'PrgH2' => $lH2,
            'PrgH3' => $lH3,
            'PrgH4' => $lH4,
            'PrgH5' => $lH5,
            'PrgH6' => $lH6,
            'PrgH7' => $lH7,  
            'npartial' => $_POST['npct'],
            'nfinal' => $_POST['ntlt'],
            'estado' => $_POST['estado'],
            'emp_id' => $userid,
            'mes'=> $mes,
            'anio' =>$anio,  
        ]);
        return redirect()->route('ingresoAudit');
    }

}

