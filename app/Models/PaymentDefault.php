<?php

namespace App\Models;

use App\Models\Client;
use App\Models\PaymentDefaulterGroupSetting;
use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentDefault extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'property_id', 'default_amount', 'paid_amount', 'missed_date'];

    protected $dates = ['missed_date'];

    // public function getDefaultAmountAttribute() {
    //     return $this->attributes['default_amount'] / 100;
    // }

    // public function setDefaultAmountAttribute($value) {
    //     return $this->attributes['default_amount'] = $value * 100;
    // }

    // public function getPaidAmountAttribute() {
    //     return $this->attributes['paid_amount'] / 100;
    // }

    // public function setPaidAmountAttribute($value) {
    //     return $this->attributes['paid_amount'] = $value * 100;
    // }

    /**
     * properties
     *
     * @return void
     */
    public function client() {
        return $this->belongsTo(Client::class)->withDefault();
    }

    /**
     * properties
     *
     * @return void
     */
    public function property() {
        return $this->belongsTo(Property::class)->withDefault();
    }

    /**
     * properties
     *
     * @return void
     */
    public function defaultersGroup() {
        return $this->belongsTo(PaymentDefaulterGroupSetting::class, 'defaulters_group_id', 'id')->withDefault();
    }

    public static function getDefaultersGroup($property) {

        // get reconstructed date
        $adjustedLastInstalmentDate = $property->reconstructLastInstalmentDate();
        $today = Carbon::today();

        // Get date difference in months
        $numberOfDefaultMonths = $property->diffBwtTodayAndInstalmentDateInMonths($adjustedLastInstalmentDate, $today);

        $defaultersGroups = PaymentDefaulterGroupSetting::orderBy('default_months', 'asc')->pluck('default_months', 'id')->toArray();

        $groupId = null;
        foreach ($defaultersGroups as $id =>$defaultersGroup) {
            if ($numberOfDefaultMonths >= $defaultersGroup) {
                $groupId = $id;
            }
        }

        return $groupId;
    }
}
