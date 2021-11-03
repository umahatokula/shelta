<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Transaction;
use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $fillable = ['estate_property_type_id', 'unique_number', 'client_id', 'payment_plan_id'];
    
    /**
     * properties
     *
     * @return void
     */
    public function estatePropertyType() {
        return $this->belongsTo(EstatePropertyType::class);
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
     * totalPaid
     *
     * @return void
     */
    public function totalPaid() {
        return Transaction::where(['property_id' => $this->client->id, 'property_id' => $this->id])->sum('amount');
    }
    
    /**
     * lastPayment
     *
     * @return void
     */
    public function lastPayment() {
        return Transaction::where(['property_id' => $this->client->id, 'property_id' => $this->id])->latest('id')->first();
    }
    
    /**
     * client
     *
     * @return void
     */
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
    
    /**
     * client
     *
     * @return void
     */
    public function transactionTotal() {
        return $this->hasMany(Transaction::class)->sum('amount');
    }
}
