<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDefaulterGroupSetting extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function defaulters() {
        return $this->hasMany(PaymentDefault::class, 'id', 'defaulters_group_id');
    }
}
