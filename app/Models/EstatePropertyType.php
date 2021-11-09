<?php

namespace App\Models;

use App\Models\Estate;
use App\Models\Property;
use App\Models\PropertyType;
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
        return $this->belongsTo(PropertyType::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function estate() {
        return $this->belongsTo(Estate::class);
    }
    
    /**
     * properties
     *
     * @return void
     */
    public function properties() {
        return $this->hasMany(Property::class);
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
