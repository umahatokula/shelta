<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendMonthlyPaymentRemindersMailable;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $property;
    public $notification_message;
    public $number_of_days_before_due_date;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($property, $notification_message, $number_of_days_before_due_date)
    {
        $this->property = $property;
        $this->notification_message = $notification_message;
        $this->number_of_days_before_due_date = $number_of_days_before_due_date;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new SendMonthlyPaymentRemindersMailable($this->property, $this->notification_message, $this->number_of_days_before_due_date))
                    ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
