<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Transaction extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['client_id', 'property_id', 'amount', 'type', 'date', 'transaction_number'];

    protected $dates = ['date'];

    public function property() {
        return $this->belongsTo(Property::class);
    }
}
