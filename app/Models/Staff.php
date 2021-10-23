<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;
    
    /**
     * properties
     *
     * @return void
     */
    public function state() {
        return $this->hasOne(User::class);
    }
}
