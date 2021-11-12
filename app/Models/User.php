<?php

namespace App\Models;

use App\Mail\SendOPT;
use App\Models\Staff;
use App\Models\Client;
use App\Models\UserCode;
use App\Events\OPTGenerated;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Twilio\Rest\Client as TwilioClient;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'staff_id', 'client_id', 'use_2fa',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'use_2fa' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * properties
     *
     * @return void
     */
    public function staff() {
        return $this->belongsTo(Staff::class, 'staff_id', 'id');
    }

    /**
     * properties
     *
     * @return void
     */
    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    /**
     * generate OTP and send sms
     *
     * @return response()
     */
    public function generateCode()
    {
        $code = rand(100000, 999999);

        UserCode::updateOrCreate([
            'user_id' => auth()->user()->id,
            'code' => $code
        ]);

        $user = auth()->user();
        $message = "Your OTP is ". $code;

        // dispatch event
        OPTGenerated::dispatch($message, $user);
    }

    /**
     * Sends sms to user using Twilio's programmable sms client
     * @param String $message Body of sms
     * @param Number $recipients string or array of phone number of recepient
     */
    public static function sendMessage($message, $recipients)
    {

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);

            $client->messages->create($recipients,
                    ['from' => $twilio_number, 'body' => $message] );


        } catch (\Exception $e) {
            info("Error: ". $e->getMessage());
        }
    }
}
