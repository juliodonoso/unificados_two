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
        $lcorreo = audit::select('audits.*','sponsors.name as nsponsor')
        ->where('audits.id',$idx)
        ->leftjoin('sponsors','sponsors.id', '=', 'audits.sponsor')->first(); 
        $lsponsor = $lcorreo->nsponsor;
        $lcamp = $lcorreo->campania;
        $leje = $lcorreo->opereva;
        $lfecha = $lcorreo->Fvta;
        $lidgrab = $lcorreo->idGrab;
        $lobserv = $lcorreo->observ;
        $lasunto = 'ALERTA '.$lsponsor.' '.$lcamp;
        $correo = new Alertmail($leje,$lcamp,$lfecha,$lidgrab,$lobserv,$lasunto);
        $correo->subject = $lasunto;
        $correo->eje = $leje;
        mail::to("ddavimo@gmail.com")->send($correo);  
        return redirect()->route('ingresoAudit');
    }

}
