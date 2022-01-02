<?php

namespace App\Helpers;

use Twilio\Rest\Client as TwilioClient;
use Illuminate\Support\Facades\Http;

class Helpers {

    /**
     * Send an SMS using Twilio
     *
     * @param  mixed $to
     * @param  mixed $message
     * @return void
     */
    public static function sendSMSMessage($to, $message) {

        $response = Http::post('https://www.bulksmsnigeria.com/api/v1/sms/create', [
          'api_token' => config('services.send_bulk_sms_nigeria.api_token'),
          'from' => config('app.name'),
          'to' => $to,
          'body' => $message,
          'dnd' => 2,
        ]);

        // $response = Http::post('http://www.smslive247.com/http/index.aspx', [
        //   'cmd' => 'sendmsg',
        //   'sessionid' => urlencode('4195840d-a848-4e80-8f14-d13d5f2ca848'),
        //   'sender' => config('app.name'),
        //   'sendto' => $to,
        //   'message' => $message,
        //   'msgtype' => 0,
        // ]);

        if ($response->ok()) {
          return 1;
        };

        // try {
        //
        //     $account_sid = getenv("TWILIO_SID");
        //     $auth_token = getenv("TWILIO_TOKEN");
        //     $twilio_number = getenv("TWILIO_FROM");
        //
        //     $twilioClient = new TwilioClient($account_sid, $auth_token);
        //     $twilioClient->messages->create($to, [
        //         'from' => $twilio_number,
        //         'body' => $message]);
        //
        // } catch (Exception $e) {
        //     \Log::info("Error: ". $e->getMessage());
        // }
        //
        // return 1;
    }

    /**
     * Send a WhatsApp message using Twilio
     *
     * @param  mixed $to
     * @param  mixed $message
     * @return void
     */
    public static function sendWhatsAppMessage($to, $message) {

        return 1; // remove this line eventually

        // try {
        //
        //     $account_sid = getenv("TWILIO_SID");
        //     $auth_token = getenv("TWILIO_TOKEN");
        //     $from = getenv("TWILIO_WHATSAPP_FROM");
        //
        //     $twilio = new TwilioClient($account_sid, $auth_token);
        //
        //     $message = $twilio->messages
        //         ->create("whatsapp:".$to, // to
        //                 [
        //                     "from" => "whatsapp:".$from,
        //                     "body" => $message
        //                 ]
        //         );
        //
        // } catch (Exception $e) {
        //     \Log::info("Error: ". $e->getMessage());
        // }
        //
        // return 1;
    }
}
