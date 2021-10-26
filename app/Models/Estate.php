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
     * The roles that belong to the user.
     */
    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class)->withTimestamps()->withPivot('price');
    }

    
    // public static function boot() {

    //     parent::boot();
        
    //     self::deleting(function($estate) { 
    //          $estate->propertyTypes()->each(function($propertyType) {
    //             $propertyType->delete(); 
    //          });
    //     });

    // }
}
