<?php

namespace ApiWebPsp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $para;

    /**
     * Create a new message instance.
     *
     * @param $order
     */
    public function __construct($para, $order)
    {
        $this->order = $order;
        $this->para = $para;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->para, 'DRS SAC')
            ->subject("Chamado novo - Protocolo: " . $this->order->protocol . " - Manifestação: " . $this->order->manifestation)
            ->markdown('mail.invoice.order');
    }
}
