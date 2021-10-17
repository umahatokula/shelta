<?php

namespace App\Models;

use App\Models\EstatePropertyGroup;
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
    public function estatePropertyGroup() {
        return $this->belongsTo(EstatePropertyGroup::class);
    }
}
