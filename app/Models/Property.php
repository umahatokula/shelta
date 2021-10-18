<?php

namespace App\Models;

use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    
    /**
     * properties
     *
     * @return void
     */
    public function estatePropertyType() {
        return $this->belongsTo(EstatePropertyType::class);
    }
}
