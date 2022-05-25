<?php

namespace App\Helpers;

use Zeevx\LaraTermii\LaraTermii;
use Illuminate\Support\Facades\Http;
use Twilio\Rest\Client as TwilioClient;

class Helpers {

    /**
     * Send an SMS using Twilio
     *
     * @param  mixed $to
     * @param  mixed $message
     * @return void
     */
    public static function sendSMSMessage($to, $message, $channel = "generic") {

        // $response = Http::post('http://www.sendsmsnigeria.com/api/', [
        //   'email' => 'umahatokula@gmail.com',
        //   'password' => 'addiction',
        //   'sender' => config('app.name'),
        //   'numbers' => $to,
        //   'message' => $message,
        // ]);

        // $response = Http::post('http://www.smslive247.com/http/index.aspx', [
        //   'cmd' => 'sendmsg',
        //   'sessionid' => urlencode('4195840d-a848-4e80-8f14-d13d5f2ca848'),
        //   'sender' => config('app.name'),
        //   'sendto' => $to,
        //   'message' => $message,
        //   'msgtype' => 0,
        // ]);

        // $response = Http::post('https://www.bulksmsnigeria.com/api/v1/sms/create', [
        //   'api_token' => config('services.send_bulk_sms_nigeria.api_token'),
        //   'from' => config('app.name'),
        //   'to' => $to,
        //   'body' => $message,
        //   'dnd' => 2,
        // ]);

        $termii = new LaraTermii(env('TERMII_API_KEY'));
        $from = 'Richboss';
        $sms = $message;

        $response = $termii->sendMessage($to, $from, $sms, $channel, $media = false, $media_url = null, $media_caption = null);
        $response = json_decode($response);

        if ($response->message == 'Successfully Sent') {
          return 1;
        };

    }

    /**
     * Send a WhatsApp message using Twilio
     *
     * @param  mixed $to
     * @param  mixed $message
     * @return void
     */
    public static function sendWhatsAppMessage($to, $message, $channel = 'whatsapp') {

        $termii = new LaraTermii(env('TERMII_API_KEY'));
        $from = 'Richboss';
        $sms = $message;

        $response = $termii->sendMessage($to, $from, $sms, $channel, $media = false, $media_url = null, $media_caption = null);
        $response = json_decode($response);

        if ($response->message == 'Successfully Sent') {
            return 1;
        };
    }


    /**
     * get suffix of a number
     * @param  int $int position
     * @return string      the suffix eg st, nd, rd, th
     */
    public static function getSuffix($number) {

        $last_digit = substr($number, -1, 1);
        $suffix = '';

        if ($number == 11 || $number == 12 || $number == 13) {
            return "th";
        } elseif ($last_digit == 1) {
            return "st";
        } elseif ($last_digit == 2 ) {
            return "nd";
        } elseif ($last_digit == 3 ) {
            return "rd";
        } else {
            return "th";
        }

    }
}
