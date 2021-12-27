<?php

namespace App\Models;

use App\Models\User;
use App\Models\Staff;
use App\Models\State;
use App\Models\Client;
use App\Models\Property;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use App\Models\OnlinePayment;
use Spatie\Sluggable\HasSlug;
use App\Models\PaymentDefault;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, HasSlug, Notifiable;

    protected $fillable = ['name', 'phone', 'email', 'address'];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['name'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['sname', 'onames'])
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Determine if the user is an administrator.
     *
     * @return bool
     */
    public function getNameAttribute()
    {
        $sname = isset($this->attributes['sname']) ? $this->attributes['sname'] : '';
        $onames = isset($this->attributes['onames']) ? $this->attributes['onames'] : '';
        
        return $sname .' '.$onames;
    }

    public function routeNotificationForWhatsApp() {
        return $this->phone;
    }
    /**
     * Set the user's first name.
     *
     * @param  string  $value
     * @return void
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = trim(str_replace(' ', '', $value));
    }

    /**
     * Ensure phone number has country code.
     *
     * @return bool
     */
    public function getPhoneAttribute($value)
    {
        $phone = $value;

        if (strlen($value) == 11) {
           $phone = '+234'.substr($value, 1);
        }

        if (strlen($value) == 10) {
           $phone = '+234'.$value;
        }

        return $phone;
    }
    
    /**
     * transactions
     *
     * @return void
     */
    public function user() {
        return $this->hasOne(User::class);
    }
    
    /**
     * transactions
     *
     * @return void
     */
    public function transactions() {
        return $this->hasMany(Transaction::class)->orderBy('created_at', 'DESC');
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function properties() {
        return $this->hasMany(Property::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function state() {
        return $this->belongsTo(State::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function nokState() {
        return $this->belongsTo(State::class, 'nok_state_id', 'id');
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function employerState() {
        return $this->belongsTo(State::class, 'employer_state_id', 'id');
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function employerCountry() {
        return $this->belongsTo(Countries::class, 'employer_country_id', 'id');
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function paymentPlan() {
        return $this->belongsTo(PaymentPlan::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function onlinePayment() {
        return $this->hasMany(OnlinePayment::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function agent() {
        return $this->belongsTo(Staff::class, 'agent_id', 'id');
    }
    
    /**
     * Get all the payment defaults on this client
     *
     * @return void
     */
    public function getClientPaymentDefaults() {
        return PaymentDefault::where('client_id', $this->id)->get();
    }
    
    /**
     * Get the total payment defaults on this client
     *
     * @return void
     */
    public function getClientPaymentDefaultsTotal() {
        return PaymentDefault::where('client_id', $this->id)->sum('default_amount');
    }
    
    public static function boot() {

        parent::boot();
        
        self::deleting(function($client) { 
             $client->user()->delete(); 
        });

    }
}
