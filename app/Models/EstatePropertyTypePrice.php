<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EstatePropertyType;
use App\Models\PropertyPrice;

class EstatePropertyTypePrice extends Model
{
    use HasFactory;

    protected $fillable = ['estate_property_type_id', 'payment_plan_id', 'property_price_id'];

    public function estatePropertyTypes() {
      return $this->belongsTo(EstatePropertyType::class, 'estate_property_type_id', 'id')->withDefault();
    }

    public function propertTypePrice() {
      return $this->belongsTo(PropertyPrice::class, 'property_price_id', 'id')->withDefault();
    }
}
