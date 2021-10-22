<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'property_id', 'amount', 'type', 'date'];

    public function property() {
        return $this->belongsTo(Property::class);
    }
}
