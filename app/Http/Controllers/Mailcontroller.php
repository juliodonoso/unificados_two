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
        $destinatario = [ 'dvillalobos@unificados.cl'];
        // $destinatario = [ 'dvillalobos@unificados.cl','imadueno@grupounificados.cl','ccid@unificados.cl'];
        $lcorreo = audit::select('audits.*','sponsors.name as nsponsor')
        ->where('audits.id',$idx)
        ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor')->first(); 
        $lsponsor = $lcorreo->nsponsor;
        $lcamp = $lcorreo->campania;
        $leje = $lcorreo->opereva;
        $lfecha = $lcorreo->Fvta;
        $lidgrab = $lcorreo->idGrab;
        $lobserv = $lcorreo->observ;
        $lcanal = $lcorreo->canal;
        $lasunto = 'ALERTA: '.$lsponsor.' '.$lcamp;
        $correo = new Alertmail($leje,$lcamp,$lfecha,$lidgrab,$lobserv,$lasunto,$lcanal);
        $correo->subject = $lasunto;
        $correo->eje = $leje;
        mail::to($destinatario)->send($correo);  
        return redirect()->route('ingresoAudit');
    }

}
