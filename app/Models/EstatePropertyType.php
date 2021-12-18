<?php

namespace App\Models;

use App\Models\Estate;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyTypePrice;
use App\Models\PaymentPlan;
use App\Models\EstatePropertyTypePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstatePropertyType extends Model
{
    use HasFactory;

    protected $table = 'estate_property_type';

    protected $fillable = ['estate_id', 'property_type_id', 'price', 'number_of_units'];

    /**
     * properties
     *
     * @return void
     */
    public function propertyType() {
        return $this->belongsTo(PropertyType::class)->withDefault();
    }

    /**
     * properties
     *
     * @return void
     */
    public function estate() {
        return $this->belongsTo(Estate::class)->withDefault();
    }

    /**
     * properties
     *
     * @return void
     */
    public function properties() {
        return $this->hasMany(Property::class);
    }

    public function prices() {
      return $this->hasMany(PropertyTypePrice::class);
    }

    public function paymentPlans() {
      return $this->hasMany(PaymentPlan::class);
    }

    public function priceOfPaymentPlan($paymentPlanId) {
      $estatePropertyTypePrice = EstatePropertyTypePrice::with('propertTypePrice')->where([
          'estate_property_type_id' => $this->id,
          'payment_plan_id' => $paymentPlanId,
        ])->first();

      return $estatePropertyTypePrice->propertTypePrice ? $estatePropertyTypePrice->propertTypePrice->price : 0;
    }

    public static function boot() {

        parent::boot();

        self::deleting(function($estatePropertyType) {
             $estatePropertyType->properties()->each(function($property) {
                $property->delete();
             });
        });

    }
}
