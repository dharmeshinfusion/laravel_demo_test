<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderSummaryMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $products;


    /**
     * Create a new message instance.
     */
    public function __construct($details, $products)
    {
        $this->details = $details;
        $this->products = $products;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Order Summary Mail')
            ->view('emails.orderSummaryMail');
    }
}
