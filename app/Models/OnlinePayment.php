<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlinePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'transaction_id',
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
    
    /**
     * properties
     *
     * @return void
     */
    public function transaction() {
        return $this->belongsTo(Transaction::class);
    }
}
