<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;

class PaymentMadeMailable extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data['client'] = $this->transaction->client;
        $data['transaction'] = $this->transaction;

        $pdfContent = PDF::loadView('pdf.reciept', $data);

        return $this->view('emails.payment_receipt')
                    ->subject('Payment Reciept')
                    ->attachData($pdfContent->output(), "reciept.pdf");
    }
}
