<?php

namespace App\Models;

use App\Models\Estate;
use App\Models\PropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EstatePropertyType extends Model
{
    use HasFactory;

    protected $table = 'estate_property_type';
    
    /**
     * properties
     *
     * @return void
     */
    public function propertyGroup() {
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
}
