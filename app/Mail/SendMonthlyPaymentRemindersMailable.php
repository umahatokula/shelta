<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class SendMonthlyPaymentRemindersMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $property;
    public $notification_message;
    public $nextDueDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($property, $notification_message, $number_of_days_before_due_date)
    {
        $this->property = $property;
        $this->notification_message = $notification_message;
        $this->nextDueDate = $property->getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue($number_of_days_before_due_date);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->message);
        return $this->subject('Monthly Subscription Reminder')->view('emails.monthlyPaymentReminders');
    }
}
