<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCartEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $da;
    public $crt;
    public function __construct($data,$cart)
    {
         $this->da = $data;
         $this->crt = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $e_data = $this->da;
        $e_crt = $this->crt;
        return $this->view('email.cart',compact('e_data','e_crt'))->subject('new Order');
    }
}
