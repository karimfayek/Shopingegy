<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCheckOutEmailCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $crt;
	public $ordr;
    public function __construct($cart,$order)
    {
		$this->crt = $cart;
		$this->ordr = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		$e_crt = $this->crt;
		$e_order = $this->ordr;
        return $this->view('email.customerCheckOut',compact('e_crt','e_order'))->subject('Your order has been received');
    }
}
