<?php

namespace App\Models;

use App\Models\Estate;
use App\Models\Property;
use Spatie\Sluggable\HasSlug;
use App\Models\PropertyTypePhoto;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PropertyType extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    use HasSlug;

    protected $fillable = ['name', 'description'];

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

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
              ->width(150)
              ->height(150)
              ->sharpen(10);
    }

    /**
     * Get all of the deployments for the project.
     */
    public function properties()
    {
        return $this->hasManyThrough(Property::class, EstatePropertyType::class);
    }


    /**
     * The roles that belong to the user.
     */
    public function estates()
    {
        return $this->belongsToMany(Estate::class, 'estate_property_type', 'property_type_id', 'estate_id')->withTimestamps()->withPivot(['price', 'number_of_units']);
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
     * Get the payment plan ID and property price ID of a property type
     *
     * @param  int $estate_id
     * @return void
     */
    public function getPaymentPlanAndPriceOfPropertType($estate_id) : Array {
        $ans = [];

        $this->estatePropertyType->where('estate_id', $estate_id)->map(function($estatePropertyType) use(&$ans) {
            return $estatePropertyType->estatePropertyTypePrices->map(function($estatePropertyTypePrice) use(&$ans) {

                return $ans[] = $estatePropertyTypePrice;

            });
        });

        return $ans;
    }

    public function scopeWithWhereHas($query, $relationship, $constraint) {
        return $query->with([$relationship => $constraint]);
    }
}
