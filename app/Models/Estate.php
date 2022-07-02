<?php

namespace App\Models;

use App\Models\PropertyType;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Estate extends Model
{
    use HasFactory;
    use HasSlug;

    protected $fillable = ['name', 'phone', 'email', 'address'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * properties
     *
     * @return void
     */
    public function estatePropertyType() {
        return $this->hasMany(EstatePropertyType::class);
    }

    /**
     * The propertyTypes that belong to the estate.
     */
    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class)->withTimestamps()->withPivot(['price', 'number_of_units']);
    }

    /**
     * Get the price of a particular propertyType in this estate.
     */
    public function onePropertyTypePrice($property_type_id)
    {
        $estatePropertyType = EstatePropertyType::where(['estate_id' => $this->id, 'property_type_id' => $property_type_id])->first();
        return $estatePropertyType ?? null;
    }

    /**
     * Get all of the properties in this estate
     */
    public function properties()
    {
        return $this->hasManyThrough(Property::class, EstatePropertyType::class);
    }


    /**
     * Get the payment plan ID and property price ID of an estate
     *
     * @param  int $estate_id
     * @return void
     */
    public function getPaymentPlanAndPriceOfPropertType($property_type_id) : Array {
        $ans = [];

        $this->estatePropertyType->where('property_type_id', $property_type_id)->map(function($estatePropertyType) use(&$ans) {
            return $estatePropertyType->estatePropertyTypePrices->map(function($estatePropertyTypePrice) use(&$ans) {

                return $ans[] = $estatePropertyTypePrice;

            });
        });

        return $ans;
    }

    /**
     * getUnallocatedPropertiesInAnEstate
     *
     * @param  mixed $estateId
     * @return void
     */
    public function getUnallocatedPropertiesInAnEstate() {
        return $this->properties()->where(function($q) {
            $q->whereNull('client_id');
        })->get();
    }

//    public static function boot() {
//
//        parent::boot();
//
//        self::deleting(function($estate) {
//            $estate->estatePropertyType()->delete();
//        });
//
//    }
}
