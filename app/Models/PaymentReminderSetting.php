<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentReminderSetting extends Model
{
    use HasFactory;

    protected $fillable = ['number_of_days_before_due_date', 'message'];
}
