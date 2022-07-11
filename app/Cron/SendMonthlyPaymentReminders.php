<?php

namespace App\Cron;

use App\Models\Transaction;
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
     * viaSMS
     *
     * @return void
     */
    public function viaSMS () :int {


        $paymentReminderDates = PaymentReminderSetting::orderBy('number_of_days_before_due_date', 'asc')->get();

        $data = [];
        foreach ($paymentReminderDates as $paymentReminderDate) {

            $properties = (new Property())->getPropertiesDueForReminder($paymentReminderDate->number_of_days_before_due_date);

            $phoneNumbers = [];
            foreach ($properties as $property) {

                // ===========GET PHONE NUMBERS===============
                $phoneNumber = $property->client ? $property->client->phone : null;
                $email = $property->client ? $property->client->email : null;

                if ($phoneNumber) {
                    if (str_starts_with($phoneNumber, '+234')) {
                        $phoneNumbers[] = $phoneNumber;
                    }
                }
            }

            $data[$paymentReminderDate->number_of_days_before_due_date] = $phoneNumbers;

            $message = $paymentReminderDate->message;
            Helpers::sendSMSMessage($phoneNumbers, $message); // send sms

        }

        \Log::info($data);

        return 1;
    }

    /**
     * viaWhatsapp
     *
     * @return void
     */
    public function viaWhatsapp () {


        $paymentReminderDates = PaymentReminderSetting::orderBy('number_of_days_before_due_date', 'asc')->get();

        foreach ($paymentReminderDates as $paymentReminderDate) {

            $properties = (new Property())->getPropertiesDueForReminder($paymentReminderDate->number_of_days_before_due_date);

            foreach ($properties as $property) {

                // ===========GET PHONE NUMBERS===============
                $phoneNumber = $property->client ? $property->client->phone : null;

                if ($phoneNumber) {
                    if ($paymentReminderDate->number_of_days_before_due_date == 0) {
                        $number_of_days = 'TODAY';
                    } else {
                        $number_of_days = $paymentReminderDate->number_of_days_before_due_date.' days';
                    }
                    \Log::info($phoneNumber);
                    Helpers::sendPaymentReminderViaWhatsapp($phoneNumber, $number_of_days); // send whatsapp msg
                }

            }
        }
    }

    /**
     * viaEmail
     *
     * @return void
     */
    public function viaEmail () {


        $paymentReminderDates = PaymentReminderSetting::orderBy('number_of_days_before_due_date', 'asc')->get();

        foreach ($paymentReminderDates as $paymentReminderDate) {

            $properties = (new Property())->getPropertiesDueForReminder($paymentReminderDate->number_of_days_before_due_date);

            $emailAddresses = [];
            foreach ($properties as $property) {

                // ===========GET PHONE NUMBERS===============
                $email = $property->client ? $property->client->email : null;

                if ($email) {
                    $emailAddresses[] = $email;
                }
            }

            $message = $paymentReminderDate->message;

            // ================SEND NOTIFICATION (Email)===================
            Mail::to($emailAddresses)->send(new SendMonthlyPaymentRemindersMailable($message));
//        Notification::send($property->client, new PaymentReminderNotification($property, $paymentReminderDate->message, $paymentReminderDate->number_of_days_before_due_date));
            \Log::info($emailAddresses);
        }

    }

}
