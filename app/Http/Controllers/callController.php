<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\period;
use App\Models\proposal;
use App\Models\sac;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class callController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()    // Index de la importacion

    {        //
       
            $ult = Period::where('is_act',true)->first();  // Periodo 
            $lmes = $ult->mes;
            $lanio = $ult->anio;         
            $user = Auth::user()->name;
            $userid = Auth::user()->id;
            $querycall = proposal::select('proposals.*','gt1.gestion as gt',
            'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
            'tp2.ntipif as tipcall','bancos.name as bk' )        
            ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
            ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
            ->leftjoin('bancos','bancos.id', '=', 'proposals.banco')
            ->where('mes',$lmes)
            ->where('anio',$lanio)
            // ->where('is_del', false)
            ->where('borrado',"0")
            ->where('is_call',false)
            ->where('rel','AS')
            ->where('emp_id',$userid)
            ->orderby('telf','ASC')
            ->get();
          
        
        

        
        
      
        $titulo = "Gestion de Llamadas";
        return view('Call.indexcall')
        ->with('titulo',$titulo)
        ->with('querycall',$querycall)
        ->with('user',$user);
        
    }

    public function gestion($ldid)  
    {
        
        $user = Auth::user()->name;
        $titulo = "Gestion de llamadas";
        $propedit =  proposal::select('proposals.*','gestion.gestion as gt','tipificacion.ntipif as tp','bancos.name as bank')
        ->where('proposals.id',$ldid)
        ->leftjoin('gestion','gestion.id', '=', 'proposals.gestion')
        ->leftjoin('tipificacion','tipificacion.id', '=', 'proposals.tipificacion')
        ->leftjoin('Bancos','bancos.codban','=','proposals.banco')
        ->where('borrado','0')
        ->where('is_call',false)     
        ->get();
        
        
        $rutterp = $propedit[0]->rutter;
        $ruttitb = $propedit[0]->rutcar;
        $lsprop =  $propedit[0]->propuesta;
        $lsmes=  $propedit[0]->mes;
        $lsanio = $propedit[0]->anio;
        // Pagador que paga mas de una propuesta
        if($rutterp == null) { // Titular que paga mas propuestas
        $pagaProp = proposal::select('rutcar','fnac','pat','mat','nom','obs','propuesta','fechavta','gestion.gestion as gt','clinica','gtcall')
        ->leftjoin('gestion','gestion.id', '=', 'proposals.gtcall')
        ->where('rutter',$ruttitb)     
        ->where('mes',$lsmes)
        ->where('anio',$lsanio)
        ->where('rel',"AS")
        ->where('borrado',"0")
        ->where('is_call',false)
        ->get();
        $lpagacount = count($pagaProp);
        } else {  // Tercero que no es titular pero paga propuestas
            $pagaProp = proposal::select('rutcar','fnac','pat','mat','nom','obs','propuesta','fechavta','gestion.gestion as gt','clinica')
            ->leftjoin('gestion','gestion.id', '=', 'proposals.gtcall')
            ->where('rutter',$rutterp) 
            ->whereNotIn('proposals.id',[$ldid])      
            ->where('mes',$lsmes)
            ->where('anio',$lsanio)
            ->where('rel',"AS")
            ->where('borrado',"0")
            ->where('is_call',false)
            ->get();
            $lpagacount = count($pagaProp);  
        }
        $lscargas = proposal::where('ruttit',$ruttitb)        
        // ->where('propuesta',$lsprop) 
        ->where('mes',$lsmes)
        ->where('anio',$lsanio)    
        ->where('borrado',"0")
        ->orderby ('rel', 'ASC')
        ->get();  

        $Nrocar = count($lscargas);  
        // dd($Nrocar);   
        return view('Call.gtcall')
        ->with('titulo',$titulo)
        ->with('ldid',$ldid)
        ->with('propedit',$propedit)
        ->with('Nrocar',$Nrocar)
        ->with('lscargas',$lscargas)
        ->with('user',$user)
        ->with('pagaProp',$pagaProp)
        ->with('lpagacount',$lpagacount);
    }

    public function grabacall($Nrocar,$ldid) 
    {
        // dd($_POST);
        if(isset($_POST['chkemail'])) {
            $lemail = true;
        } else {
            $lemail = false;
        }
        if(isset($_POST['chkedit'])) {
            $ledit = true;
        } else {
            $ledit = false;
        }
        if(isset($_POST['quantity'])) {
            $ladic = $_POST['quantity'];
        } 
        if(isset($_POST['ejec01'])) {
            $leje = $_POST['ejec01'];
        } else {
            $leje = Auth::user()->id;
        }
        
        Proposal::where('id', $ldid)        
        ->update([
        'gtcall' => $_POST['gestion'],
        'tipificacion' => $_POST['tipif'] ?? null,
        'Observaciones' => $_POST['observa']?? null,
        'is_mail' => $lemail,
        'is_edit' => $ledit,
        'is_adic' => $ladic,
        'emp_id' => $leje
        ]);
        Cache::forget('querycall');
        return back();
        // return redirect('call');

    }

    public function filtradas() 
    
    {
        //
        // dd($_POST);
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $lmes = $ult->mes;
        $lanio = $ult->anio; 
        if(isset( $_POST['callgt'])) {
            $lsoption = $_POST['callgt'];
            // dd($lsoption);
            if($lsoption == 4) {
                $querycall = proposal::select('proposals.*','gt1.gestion as gt',
                'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
                'tp2.ntipif as tipcall','bancos.name as bk' )        
                ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
                ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
                ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
                ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
                ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
                ->leftjoin('bancos','bancos.id', '=', 'proposals.banco')
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('proposals.gtcall',null)
                ->orwhere('proposals.gtcall',"4")
                ->where('borrado','0')
                ->where('is_call',false)
                ->where('rel','AS')
                ->orderby('telf','ASC')
                ->get();
            } else {
                $querycall = proposal::select('proposals.*','gt1.gestion as gt',
                'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
                'tp2.ntipif as tipcall','bancos.name as bk' )        
                ->leftjoin('gestion as gt1','gt1.id', '=', 'proposals.gestion')
                ->leftjoin('gestion as gt2','gt2.id', '=', 'proposals.gtcall')
                ->leftjoin('tipificacion as tp1','tp1.id', '=', 'proposals.tipificacion')
                ->leftjoin('tipificacion as tp2','tp2.id', '=', 'proposals.tpcall')
                ->leftjoin('tipificacion as tp3','tp3.id', '=', 'proposals.subtipif')
                ->leftjoin('bancos','bancos.id', '=', 'proposals.banco')
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('proposals.gtcall',$lsoption)
                ->where('borrado','0')
                ->where('is_call',false)
                ->where('rel','AS')
                ->orderby('telf','ASC')
                ->get();

            }
            // dd($querycall);
            $titulo = "Gestion de Llamadas";
            return view('Call.indexcall')
            ->with('titulo',$titulo)
            ->with('querycall',$querycall);
        } else {
            return back();
        }

    }

    // Sacs

    public function indexsacs() 
    {
        if (Cache::has('querycall')) {
            $querycallsacs = Cache::get('querycallsacs');
            $user = Cache::get('user');
        } else {
            $ult = Period::where('is_act',true)->first();  // Periodo 
            $lmes = $ult->mes;
            $lanio = $ult->anio;         
            $user = Auth::user()->name;
            $userid = Auth::user()->id;
            $querycallsacs= sac::select('sacs.*','gt1.gestion as gt',
            'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
            'tp2.ntipif as tipcall','bancos.name as bk' )        
            ->leftjoin('gestion as gt1','gt1.id', '=', 'sacs.gestion')
            ->leftjoin('gestion as gt2','gt2.id', '=', 'sacs.gtcall')
            ->leftjoin('tipificacion as tp1','tp1.id', '=', 'sacs.tipificacion')
            ->leftjoin('tipificacion as tp2','tp2.id', '=', 'sacs.tpcall')
            ->leftjoin('tipificacion as tp3','tp3.id', '=', 'sacs.subtipif')
            ->leftjoin('bancos','bancos.id', '=', 'sacs.banco')
            ->where('mes',$lmes)
            ->where('anio',$lanio)
            // ->where('is_del', false)
            ->where('borrado','0')
            ->where('is_call',false)
            ->where('rel','AS')
            ->where('emp_id',$userid)
            ->orderby('telf','ASC')
            ->get();
             Cache::put('$querycallsacs',$querycallsacs);
             Cache::put('user',$user);
        }
        

        
        
      
        $titulo = "Gestion de Llamadas";
        return view('Call.indexsacs')
        ->with('titulo',$titulo)
        ->with('querycallsacs',$querycallsacs)
        ->with('user',$user);

    }


    public function filtsacs() 
    {
        $ult = Period::where('is_act',true)->first();  // Periodo 
        $lmes = $ult->mes;
        $lanio = $ult->anio; 
        if(isset( $_POST['callgt'])) {
            $lsoption = $_POST['callgt'];
            // dd($lsoption);
            if($lsoption == 4) {
                $querycall = sac::select('sacs.*','gt1.gestion as gt',
                'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
                'tp2.ntipif as tipcall','bancos.name as bk' )        
                ->leftjoin('gestion as gt1','gt1.id', '=', 'sac.gestion')
                ->leftjoin('gestion as gt2','gt2.id', '=', 'sacs.gtcall')
                ->leftjoin('tipificacion as tp1','tp1.id', '=', 'sacs.tipificacion')
                ->leftjoin('tipificacion as tp2','tp2.id', '=', 'sacs.tpcall')
                ->leftjoin('tipificacion as tp3','tp3.id', '=', 'sacs.subtipif')
                ->leftjoin('bancos','bancos.id', '=', 'sacs.banco')
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('sacs.gtcall',null)
                ->orwhere('sacs.gtcall',"4")
                ->where('borrado','0')
                ->where('is_call',false)
                ->where('rel','AS')
                ->orderby('telf','ASC')
                ->get();
            } else {
                $querycallsacs = sac::select('sacs.*','gt1.gestion as gt',
                'tp1.ntipif as tp','tp3.ntipif as stpc','gt2.gestion as llamada',
                'tp2.ntipif as tipcall','bancos.name as bk' )        
                ->leftjoin('gestion as gt1','gt1.id', '=', 'sacs.gestion')
                ->leftjoin('gestion as gt2','gt2.id', '=', 'sacs.gtcall')
                ->leftjoin('tipificacion as tp1','tp1.id', '=', 'sacs.tipificacion')
                ->leftjoin('tipificacion as tp2','tp2.id', '=', 'sacs.tpcall')
                ->leftjoin('tipificacion as tp3','tp3.id', '=', 'sacs.subtipif')
                ->leftjoin('bancos','bancos.id', '=', 'sacs.banco')
                ->where('mes',$lmes)
                ->where('anio',$lanio)
                ->where('sacs.gtcall',$lsoption)
                ->where('borrado','0')
                ->where('is_call',false)
                ->where('rel','AS')
                ->orderby('telf','ASC')
                ->get();

            }
            
            $titulo = "Llamadas Sacs";
            return view('Call.indexsacs')
            ->with('titulo',$titulo)
            ->with('querycall',$querycallsacs);
        } else {
            return back();
        }
    }

    public function gtsacs($ldid) 
    {
        $user = Auth::user()->name;
        $titulo = "Gestion de llamadas";
        $propedit =  proposal::table('sacs')
        ->select('sacs.*','gestion.gestion as gt','tipificacion.ntipif as tp','bancos.name as bank')
        ->where('sacs.id',$ldid)
        ->leftjoin('gestion','gestion.id', '=', 'sacs.gestion')
        ->leftjoin('tipificacion','tipificacion.id', '=', 'sacs.tipificacion')
        ->leftjoin('Bancos','bancos.codban','=','sacs.banco')
        ->where('borrado','0')
        ->where('is_call',false)     
        ->get();
        
        
        $rutterp = $propedit[0]->rutter;
        $ruttitb = $propedit[0]->rutcar;
        $lsprop =  $propedit[0]->propuesta;
        $lsmes=  $propedit[0]->mes;
        $lsanio = $propedit[0]->anio;
        // Pagador que paga mas de una propuesta
        if($rutterp == null) { // Titular que paga mas propuestas
        $pagaProp = proposal::table('sacs')
        ->select('sacs.rutcar','sacs.fnac','sacs.pat','sacs.mat','sacs.nom','sacs.obs','sacs.propuesta','sacs.fechavta',
        'gestion.gestion as gt','sacs.clinica','sacs.gtcall')
        ->leftjoin('gestion','gestion.id', '=', 'sacs..gtcall')
        ->where('rutter',$ruttitb)     
        ->where('mes',$lsmes)
        ->where('anio',$lsanio)
        ->where('rel',"AS")
        ->where('borrado',"0")
        ->where('is_call',false)
        ->get();
        $lpagacount = count($pagaProp);
        } else {  // Tercero que no es titular pero paga propuestas
            $pagaProp = proposal::table('sacs')
            ->select('sacs.rutcar','sacs.fnac','sacs.pat','sacs.mat','sacs.nom','sacs.obs','sacs.propuesta','sacs.fechavta',
            'gestion.gestion as gt','sacs.clinica')
            ->leftjoin('gestion','gestion.id', '=', 'sacs.gtcall')
            ->where('rutter',$rutterp) 
            ->whereNotIn('sacs.id',[$ldid])      
            ->where('mes',$lsmes)
            ->where('anio',$lsanio)
            ->where('rel',"AS")
            ->where('borrado',"0")
            ->where('is_call',false)
            ->get();
            $lpagacount = count($pagaProp);  
        }
        $lscargas = proposal::table('sacs')
        ->where('ruttit',$ruttitb)        
        // ->where('propuesta',$lsprop) 
        ->where('mes',$lsmes)
        ->where('anio',$lsanio)    
        ->where('borrado',"0")
        ->orderby ('rel', 'ASC')
        ->get();  

        $Nrocar = count($lscargas);  
        // dd($Nrocar);   
        return view('Call.gtsacs')
        ->with('titulo',$titulo)
        ->with('ldid',$ldid)
        ->with('propedit',$propedit)
        ->with('Nrocar',$Nrocar)
        ->with('lscargas',$lscargas)
        ->with('user',$user)
        ->with('pagaProp',$pagaProp)
        ->with('lpagacount',$lpagacount);
    }

    public function grabacallsacs($Nrocar,$ldid) 
    {
        // dd($_POST);
        if(isset($_POST['chkemail'])) {
            $lemail = true;
        } else {
            $lemail = false;
        }
        if(isset($_POST['chkedit'])) {
            $ledit = true;
        } else {
            $ledit = false;
        }
        if(isset($_POST['quantity'])) {
            $ladic = $_POST['quantity'];
        } 
        if(isset($_POST['ejec01'])) {
            $leje = $_POST['ejec01'];
        } else {
            $leje = Auth::user()->id;
        }
        
        Proposal::where('id', $ldid)        
        ->update([
        'gtcall' => $_POST['gestion'],
        'tipificacion' => $_POST['tipif'] ?? null,
        'Observaciones' => $_POST['observa']?? null,
        'is_mail' => $lemail,
        'is_edit' => $ledit,
        'is_adic' => $ladic,
        'emp_id' => $leje
        ]);
        return back();

    }



}
