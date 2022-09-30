<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendCodigoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $codigo;
    public $cupom;
    public function __construct($codigo, $cupom)
    {
        $this->codigo = $codigo;
        $this->cupom = $cupom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('codigoMail')->with([
            'codigo' => $this->codigo, 
            'cupom' => $this->cupom
            ]);
    }
}
