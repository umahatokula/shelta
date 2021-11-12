<?php

namespace App\Models;

use App\Models\User;
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

    protected $fillable = ['client_id', 'property_id', 'amount', 'type', 'date', 'transaction_number', 'proof_reference_number', 'by'];

    protected $dates = ['date'];

    public function property() {
        return $this->belongsTo(Property::class);
    }
        
    /**
     * onlinePayment
     *
     * @return void
     */
    public function onlinePayment() {
        return $this->hasOne(OnlinePayment::class);
    }

    public function performed_by() {
        return $this->belongsTo(User::class, 'by', 'id')->withDefault();
    }
}
