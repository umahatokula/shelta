<?php

namespace App\Cron;

use Carbon\Carbon;
use App\Models\Client;
use App\Helpers\Helpers;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;
use App\Models\PaymentReminderSetting;
use App\Models\EstatePropertyTypePrice;
use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Notification;
use App\Mail\SendMonthlyPaymentRemindersMailable;
use App\Notifications\PaymentReminderNotification;

class SendMonthlyPaymentReminders {

    /**
     * __invoke
     *
     * @return void
     */
    public function __invoke () {


        $paymentReminderDates = PaymentReminderSetting::orderBy('number_of_days_before_due_date', 'asc')->get();

        $data = [];
        foreach ($paymentReminderDates as $paymentReminderDate) {

            $properties = (new Property())->getPropertiesDueForReminder($paymentReminderDate->number_of_days_before_due_date);

            $phoneNumbers = [];
            $emailAddresses = [];
            foreach ($properties as $property) {

                // ===========GET PHONE NUMBERS===============
                $phoneNumber = $property->client ? $property->client->phone : null;
                $email = $property->client ? $property->client->email : null;

                if ($phoneNumber) {
                    if (str_starts_with($phoneNumber, '+234')) {
                        $phoneNumbers[] = $phoneNumber;
                    }

                    if ($paymentReminderDate->number_of_days_before_due_date == 0) {
                        $number_of_days = 'TODAY';
                    } else {
                        $number_of_days = $paymentReminderDate->number_of_days_before_due_date.' days';
                    }
                    Helpers::sendPaymentReminderViaWhatsapp($phoneNumber, $number_of_days); // send whatsapp msg
                }

                if ($email) {
                    $emailAddresses[] = $email;
                }
            }

            $data[$paymentReminderDate->number_of_days_before_due_date] = $phoneNumbers;

            $message = $paymentReminderDate->message;
            Helpers::sendSMSMessage($phoneNumbers, $message); // send sms

            // ================SEND NOTIFICATION (Email)===================
            Mail::to($emailAddresses)->send(new SendMonthlyPaymentRemindersMailable($message));
//        Notification::send($property->client, new PaymentReminderNotification($property, $paymentReminderDate->message, $paymentReminderDate->number_of_days_before_due_date));
        }

        \Log::info($data);
    }

}
