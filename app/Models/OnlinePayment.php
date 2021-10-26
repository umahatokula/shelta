<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'message',
        'reference',
        'status',
        'amount',
    ];
    
    /**
     * properties
     *
     * @return void
     */
    public function state() {
        return $this->belongsTo(Client::class);
    }
}
