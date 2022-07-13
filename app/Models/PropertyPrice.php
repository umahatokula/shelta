<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PropertyType;

class PropertyPrice extends Model
{
    use HasFactory;

    protected $fillable = ['price', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function getPriceAttribute() {
        return isset($this->attributes['price']) ? $this->attributes['price'] / 100 : 0;
    }

    public function setPriceAttribute($value) {
        $this->attributes['price'] = $value * 100;
    }

    public function properties() {
        return $this->hasMany(PropertyType::class);
    }
}
