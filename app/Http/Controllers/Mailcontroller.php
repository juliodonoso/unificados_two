<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Alertmail;
use App\Models\Audit;
use Illuminate\Support\Facades\Mail;  

class Mailcontroller extends Controller
{
    //
    
    public function sendmail($idx) {
        //  Pruebas 
        // $destinatario = ['dvillalobos@unificados.cl'];
        // $cc = ['dvillalobos@unificados.cl'];
        // Produccion 
        $destinatario = ['veronica.tapia@metlife.cl '];
        $cc = ['bverdejo@unificados.cl', 'ccid@unificados.cl', 'imadueno@grupounificados.cl', 'rfernandez@unificados.cl', 'fdonosol@metlife.cl' ];
        $markalert = audit::find($idx);
        $markalert->alert = 1;
        $markalert->save();
        
        $lcorreo = audit::select('audits.*','sponsors.name as nsponsor','users.name as nombre')
        ->where('audits.id',$idx)
        ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor')
        ->leftjoin('users','users.id', '=', 'audits.emp_id')->first(); 
        $lsponsor = $lcorreo->nsponsor;
        $lcamp = $lcorreo->campania;
        $leje = $lcorreo->opereva;
        $lfecha = $lcorreo->Fvta;
        $lidgrab = $lcorreo->idGrab;
        $lobserv = $lcorreo->observ;
        $lcanal = $lcorreo->canal;
        $lname = $lcorreo->nombre;
        $lasunto = 'ALERTA : '.$lsponsor.' '.$lcamp;
        $correo = new Alertmail($leje,$lcamp,$lfecha,$lidgrab,$lobserv,$lasunto,$lcanal,$lname);
        $correo->subject = $lasunto;
        $correo->eje = $leje;
        mail::to($destinatario)
        ->cc($cc)->send($correo);  
        return redirect()->route('ingresoAudit');
    }

}
