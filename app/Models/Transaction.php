<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Property;
use App\Models\Transaction;
use App\Models\OnlinePayment;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Transaction extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['client_id',
                            'property_id',
                            'property_id',
                            'amount',
                            'transaction_number',
                            'type',
                            'recorded_by',
                            'recorded_by_staff',
                            'proof_reference_number',
                            'date',
                            'status',
                            'is_approved',
                            'processed_by',
                        ];

    protected $dates = ['date'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_approved' => 'boolean',
    ];

    /**
     * Scope a query to only include active users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return void
     */
    public function scopeIsApproved($query)
    {
        $query->where('status', 1);
    }
    
    /**
     * property
     *
     * @return void
     */
    public function property() {
        return $this->belongsTo(Property::class);
    }
    
    /**
     * client
     *
     * @return void
     */
    public function client() {
        return $this->belongsTo(Client::class);
    }
        
    /**
     * onlinePayment
     *
     * @return void
     */
    public function onlinePayment() {
        return $this->hasOne(OnlinePayment::class);
    }
    
    /**
     * performed_by
     *
     * @return void
     */
    public function recordedBy() {
        return $this->belongsTo(User::class, 'recorded_by', 'id')->withDefault();
    }
    
    /**
     * performed_by
     *
     * @return void
     */
    public function processedBy() {
        return $this->belongsTo(User::class, 'processed_by', 'id')->withDefault();
    }

    public function getTotal() {
        return Transaction::sum('amount');
    }
}
