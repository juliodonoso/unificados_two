<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Alertmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Alerta en Llamada";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leje,$lcamp,$lfecha,$lidgrab,$lobserv,$lasunto)
    {
        //
        $this->eje = $leje;
        $this->camp = $lcamp;
        $this->venta = $lfecha;
        $this->grab = $lidgrab;
        $this->observ = $lobserv;
        $this->lasunto = $lasunto;
  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.alertas')
        ->with([
            'subject' => '1',
            'eje' => $this->eje,
            'camp' => $this->camp,
            'venta' => $this->venta,
            'grab' => $this->grab,
            'observ' => $this->observ,
            'lasunto' => $this->lasunto
        ]);
    }
}
