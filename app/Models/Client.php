<?php

namespace App\Models;

use App\Models\Staff;
use App\Models\State;
use App\Models\Property;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use PragmaRX\Countries\Package\Countries;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'phone', 'email', 'address'];

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
     * transactions
     *
     * @return void
     */
    public function transactions() {
        return $this->hasMany(Transaction::class);
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
    public function agent() {
        return $this->belongsTo(Staff::class, 'agent_id', 'id');
    }
}
