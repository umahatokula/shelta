<?php

namespace App\Models;

use App\Models\User;
use App\Models\Client;
use App\Models\Property;
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
}
