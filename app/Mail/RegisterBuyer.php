<?php

namespace ApiWebPsp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterBuyer extends Mailable
{
    use Queueable, SerializesModels;

    private $para;
    public $order;
    public $scheduling;

    /**
     * Create a new message instance.
     *
     * @param $para
     * @param $order
     * @param $scheduling
     */
    public function __construct($para, $order, $scheduling)
    {
        $this->para = $para;
        $this->order = $order;
        $this->scheduling = $scheduling;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from($this->para,'DRS SAC - Agendamento')
            ->subject('Agendamento Realizado')->markdown('mail.invoice.scheduling');
    }
}
