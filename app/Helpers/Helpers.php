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
    public static function sendSMSMessage($to, string $message) {

        // $response = Http::post('http://www.sendsmsnigeria.com/api/', [
        //   'email' => 'umahatokula@gmail.com',
        //   'password' => 'addiction',
        //   'sender' => config('app.name'),
        //   'numbers' => $to,
        //   'message' => $message,
        // ]);

//         $response = Http::post('http://www.smslive247.com/http/index.aspx', [
//           'cmd' => 'sendmsg',
//           'sessionid' => urlencode('4195840d-a848-4e80-8f14-d13d5f2ca848'),
//           'sender' => config('app.name'),
//           'sendto' => $to,
//           'message' => $message,
//           'msgtype' => 0,
//         ]);

//         $response = Http::post('https://www.bulksmsnigeria.com/api/v1/sms/create', [
//           'api_token' => config('services.send_bulk_sms_nigeria.api_token'),
//           'from' => config('app.name'),
//           'to' => $to,
//           'body' => $message,
//           'dnd' => 2,
//         ]);

        $response = Http::post(env('TERMII_API_ENDPOINT'), [
            'api_key' => env('TERMII_API_KEY'),
            'to' => $to,
            'from' => env('TERMII_SMS_SENDER_ID'),
            'sms' => $message,
            'type' => 'plain',
            'channel' => env('TERMII_SMS_CHANNEL'),
        ]);

        $response = json_decode($response);

        return $response->message;

    }

    /**
     * Send an OTP using WhatsApp (WATI)
     *
     * @param  mixed $to
     * @param  mixed $first_name
     * @return void
     */
    public static function sendOTPViaWhatsapp($to, $otp) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('WATI_ENDPOINT').'/api/v1/sendTemplateMessage?whatsappNumber='.$to,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "template_name": "login_otp",
                "broadcast_name": "login_otp",
                "parameters": [
                    {
                        "name": "otp",
                        "value": "'.$otp.'"
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.env('WATI_TOKEN'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return json_decode($response);
    }


    /**
     * Send an OTP using WhatsApp (WATI)
     *
     * @param  mixed $to
     * @param  mixed $first_name
     * @return void
     */
    public static function sendPaymentReminderViaWhatsapp($to, $number_of_days) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('WATI_ENDPOINT').'/api/v1/sendTemplateMessage?whatsappNumber='.$to,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                "template_name": "instalment_reminder",
                "broadcast_name": "instalment_reminder",
                "parameters": [
                    {
                        "name": "number_of_days",
                        "value": "'.$number_of_days.'"
                    }
                ]
            }',
            CURLOPT_HTTPHEADER => array(
                'Authorization: '.env('WATI_TOKEN'),
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//        dd(json_decode($response));

        return json_decode($response);
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
