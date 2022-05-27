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

        $paymentReminderDates = PaymentReminderSetting::all();

        foreach ($paymentReminderDates as $paymentReminderDate) {

            $properties = (new Property())->getPropertiesDueForReminder($paymentReminderDate->number_of_days_before_due_date);

            foreach ($properties as $property) {

                // ===========SNED SMS===============
                $receiverNumber = $property->client ? $property->client->phone : null;
                $message = $paymentReminderDate->message;

                if ($receiverNumber) {
                    Helpers::sendSMSMessage($receiverNumber, $message); // send sms
                    Helpers::sendWhatsAppMessage($receiverNumber, $message); // send whatsapp message
                }

                // ================SEND NOTIFICATION (Email)===================
                Notification::send($property->client, new PaymentReminderNotification($property, $paymentReminderDate->message, $paymentReminderDate->number_of_days_before_due_date));
            }
        }

    }

}
