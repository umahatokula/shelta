<?php

namespace App\Models;

use App\Models\PaymentPlan;
use App\Models\PropertyPrice;
use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstatePropertyTypePrice extends Model
{
    use HasFactory;

    protected $fillable = ['estate_property_type_id', 'payment_plan_id', 'property_price_id'];
    
    /**
     * estatePropertyType
     *
     * @return void
     */
    public function estatePropertyType() {
      return $this->belongsTo(EstatePropertyType::class, 'estate_property_type_id', 'id')->withDefault();
    }
    
    /**
     * propertyPrice
     *
     * @return void
     */
    public function paymentPlan() {
      return $this->belongsTo(PaymentPlan::class, 'payment_plan_id', 'id')->withDefault();
    }
    
    /**
     * propertyPrice
     *
     * @return void
     */
    public function propertyPrice() {
      return $this->belongsTo(PropertyPrice::class, 'property_price_id', 'id')->withDefault();
    }
}
