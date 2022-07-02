<?php

namespace App\Models;

use App\Models\Estate;
use App\Models\Property;
use App\Models\PaymentPlan;
use App\Models\PropertyType;
use App\Models\PropertyPrice;
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

    /**
     * estatePropertyTypePrices
     *
     * @return void
     */
    public function estatePropertyTypePrices() {
      return $this->hasMany(EstatePropertyTypePrice::class);
    }


    /**
     * Get the price of a payment plan
     *
     * @param  int $paymentPlanId
     * @return int
     */
    public function priceOfPaymentPlan($paymentPlanId) {
      $estatePropertyTypePrice = EstatePropertyTypePrice::with('propertyPrice')->where([
          'estate_property_type_id' => $this->id,
          'payment_plan_id' => $paymentPlanId,
        ])->first();

      if (!$estatePropertyTypePrice) {
        return 0;
      }

      return $estatePropertyTypePrice->propertyPrice ? $estatePropertyTypePrice->propertyPrice->price : 0;

    }

    public static function boot() {

        parent::boot();

        self::deleting(function($estatePropertyType) {

             $estatePropertyType->properties()->each(function($property) {
                $property->estate_property_type_id = null;
                $property->save();
             });

        });

    }

    public function getEstatePropertyTypeClient() {

        // get all properties of this property type in this estate
        $properties = Property::whereIn('estate_property_type_id', function ($query) {
            $query->select('id')
                ->from('estate_property_type')
                ->where('estate_property_type.estate_id', '=', $this->estate_id)
                ->where('estate_property_type.property_type_id', '=', $this->property_type_id)
                ->get()
                ->toArray();
        })
            ->whereNotNull('client_id')
            ->get();


        return $properties->map(function($property) {

            $client =  $property->client->load('transactions');
            $client->unpaid = $property->getPropertyPrice() - $property->totalPaid();
            $client->paid = $property->totalPaid();

            return [
                'client' => $client,
                'property' => $property,
                'estate' => $this->estate,
                'propertyType' => $this->propertyType,
            ];
        });
    }

}
