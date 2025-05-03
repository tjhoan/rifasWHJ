<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class FacturaMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $factura;
    public $cliente;
    public $carrito;

    public function __construct($factura, $cliente, $carrito)
    {
        $this->factura = $factura;
        $this->cliente = $cliente;
        $this->carrito = $carrito;

        Log::info('FacturaMailable creado.', [
            'factura' => $factura,
            'cliente' => $cliente,
            'carrito' => $carrito
        ]);
    }

    public function build()
    {
        return $this->view('emails.factura')
            ->subject('Factura de Compra - Rifas WHJ')
            ->with([
                'factura' => $this->factura,
                'cliente' => $this->cliente,
                'carrito' => $this->carrito,
            ]);
    }
}
