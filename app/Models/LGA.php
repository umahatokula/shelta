<?php

namespace App\Models;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LGA extends Model
{
    use HasFactory;

    protected $table = 'local_governments';

    protected $fillable = ['state_id', 'name'];
    
    /**
     * properties
     *
     * @return void
     */
    public function state() {
        return $this->belongsTo(State::class);
    }
}
