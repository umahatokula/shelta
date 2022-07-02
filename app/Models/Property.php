<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Client;
use App\Helpers\Helpers;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use App\Models\PaymentDefault;
use App\Models\PropertyTypePrice;
use App\Models\EstatePropertyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $dates = ['date_of_first_payment'];

    protected $fillable = ['estate_property_type_id', 'unique_number', 'client_id', 'payment_plan_id', 'date_of_first_payment', 'next_due_date'];

    /**
     * properties
     *
     * @return void
     */
    public function estatePropertyType() {
        return $this->belongsTo(EstatePropertyType::class)->withDefault();
    }

    /**
     * properties
     *
     * @return void
     */
    public function scopeUnallocated($query) {
        return $query->where('client_id', null);
    }

    /**
     * client
     *
     * @return void
     */
    public function client() {
        return $this->belongsTo(Client::class)->withDefault();
    }

    /**
     * paymentPlan
     *
     * @return void
     */
    public function paymentPlan() {

        return $this->belongsTo(PaymentPlan::class)->withDefault();
    }

    /**
     * totalPaid
     *
     * @return void
     */
    public function totalPaid() {
        return Transaction::where(['client_id' => $this->client->id, 'property_id' => $this->id])->isApproved()->sum('amount');
    }

    /**
     * lastPayment
     *
     * @return void
     */
    public function lastPayment() {
        return Transaction::where(['client_id' => $this->client->id, 'property_id' => $this->id])->isApproved()->latest('id')->first();
    }

    /**
     * last instalment Payment
     *
     * @return void
     */
    public function lastInstalmentPayment() {
        return Transaction::where(['client_id' => $this->client->id, 'property_id' => $this->id])->isApproved()->latest('id')->first();
    }

    /**
     * client
     *
     * @return void
     */
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }

    /**
     * get transaction total
     *
     * @return void
     */
    public function transactionTotal() {
        return $this->hasMany(Transaction::class)->isApproved()->sum('amount');
    }

    /**
     * Get reconstructed last instalment date. This ensures due date is not greater than 28. This is because Feb has 28 days in non-leap years so we use this minimum number of days as our payment cycle.
     *
     * @return void
     */
    public function reconstructLastInstalmentDate() : Carbon {

        $day = 28;
        if ($this->date_of_first_payment) {

            if ($this->date_of_first_payment->day < 28) {
                $day = $this->date_of_first_payment->day;
            }

        } else {
            $day = Carbon::today()->day;
        }


        // extract month and year from last instalment date. Then reconstruct NEW last instalment date. If there's no instalment date, use date of first instalment, else use date client profile was created
        if ($this->lastInstalmentPayment()->instalment_date) {

            $lastInstalmentDate = $this->lastInstalmentPayment()->instalment_date;

        } elseif ($this->date_of_first_payment) {

            $lastInstalmentDate = $this->date_of_first_payment;

        } else {

            $lastInstalmentDate = $this->client->created_at;

        }


        if ($lastInstalmentDate) {
            $month = $lastInstalmentDate->month;
            $year = $lastInstalmentDate->year;

            $adjustedLastInstalmentDate = Carbon::parse($month.'/'.$day.'/'.$year);
        }

        return $adjustedLastInstalmentDate;
    }

    /**
     * Get date difference in months. This is in case last instament was made more than a month ago, we want to add up the number of months bwt the last instalment and the current month
     *
     * @return int
     */
    public function diffBwtTodayAndInstalmentDateInMonths(Carbon $date1, Carbon $date2) : int {

        $date1_month = $date1->format('m');
        $date2_month = $date2->format('m');

        $absDiff = abs($date1_month - $date2_month);
        $years = \intdiv($absDiff, 12);
        $months = $absDiff % 12;

        $diff = ($years * 12) + $months;

        return $diff;

    }


    /**
     * nextPaymentDueDate
     *
     * @return void
     */
    public function nextPaymentDueDate() {

        if (is_null($this->date_of_first_payment) || is_null($this->lastInstalmentPayment())) {
            return;
        }

        // get reconstructed date
        $adjustedLastInstalmentDate = $this->reconstructLastInstalmentDate();
        $today = Carbon::today();

        // Get date difference in months
        $diffInMonths = $this->diffBwtTodayAndInstalmentDateInMonths($adjustedLastInstalmentDate, $today);

        if (($adjustedLastInstalmentDate->format('m')) >= (Carbon::today()->format('m'))) {
            $nextDueDate = $adjustedLastInstalmentDate->addMonth();
        } else {
            $nextDueDate = $adjustedLastInstalmentDate->addMonth($diffInMonths);
        }

        return $nextDueDate;
    }

    /**
     * getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue
     *
     * @return void
     */
    public function getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue($number_of_days_to_due_date) : Carbon {

        $nextDueDate = Carbon::today()->addDays($number_of_days_to_due_date);

        $day = $nextDueDate->day;
        $month = $nextDueDate->month;
        $year = $nextDueDate->year;

        return Carbon::parse($month.'/'.$day.'/'.$year);
    }


    /**
     * @param $number_of_days_to_due_date
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPropertiesDueForReminder($number_of_days_to_due_date) {

      $nextDueDate = Carbon::today()->addDays($number_of_days_to_due_date);

      return $this->with('client')
          ->whereNotNull('client_id')
          ->whereNotNull('date_of_first_payment')
          ->get()
          ->filter(function ($property) use ($nextDueDate) {
              return ($property->nextPaymentDueDate() == $nextDueDate) && $property->transactionTotal() < $property->getPropertyPrice();
          });
    }

    /**
     * Get the Payment plan and Price this property is attached to
     *
     * @return void
     */
    public function getPaymentPlanAndPrice() {

        return $this->estatePropertyType->estatePropertyTypePrices->filter(function($estatePropertyTypePrice) {
            return $this->payment_plan_id == $estatePropertyTypePrice->payment_plan_id;
        })->first();

    }


    /**
     * Get the price for this property
     *
     * @return void
     */
    public function getPropertyPrice() {

        $paymentPlanAndPrice = $this->getPaymentPlanAndPrice();

        if (!$paymentPlanAndPrice) {
            return null;
        }

        return $paymentPlanAndPrice->propertyPrice ? $paymentPlanAndPrice->propertyPrice->price : null;
    }

    /**
     * Get Monthly Payment Amount
     *
     * @return float
     */
    public function getMonthlyPaymentAmount() : float {

        $paymentPlanAndPrice = $this->getPaymentPlanAndPrice();

        if (!$paymentPlanAndPrice) {
            return 0.00;
        }

        $paymentPlanNumberOfMonths = $paymentPlanAndPrice->paymentPlan->number_of_months;
        $price = $paymentPlanAndPrice->propertyPrice->price;

        if ($paymentPlanNumberOfMonths == 0) {
            return $price;
        }

        return $price / $paymentPlanNumberOfMonths;
    }


    /**
     * Get all the payment defaults on this property
     *
     * @return void
     */
    public function getClientPaymentDefaults() {
        return PaymentDefault::where('property_id', $this->id)->get();
    }

    /**
     * Get the total payment defaults on this property
     *
     * @return void
     */
    public function getClientPaymentDefaultsTotal() {
        return PaymentDefault::where('property_id', $this->id)->sum('default_amount');
    }

    /**
     * Get the total paid to clear up payment defaults on this property
     *
     * @return void
     */
    public function getClientPaymentDefaultsCreditTotal() {
        return PaymentDefault::where('property_id', $this->id)->sum('paid_amount');
    }

    /**
     * Get the total paid to clear up payment defaults on this property
     *
     * @return void
     */
    public function getClientPaymentDefaultsBalance() {
        return $this->getClientPaymentDefaultsTotal() - $this->getClientPaymentDefaultsCreditTotal();
    }

    /**
     * propertyPaymentDateSuffix
     *
     * @param  mixed $day
     * @return void
     */
    public function propertyPaymentDateSuffix($day) {
        return Helpers::getSuffix($day);
    }


    /**
     * Get unallocated properties.
     * @param $estate_id
     * @param $property_type_id
     * @return \Illuminate\Support\Collection
     */
    public function getUnallocatedAllocatedProperties($estate_id, $property_type_id) {

        $estatePropertyType = EstatePropertyType::where(['estate_id' => $estate_id, 'property_type_id' => $property_type_id])->first();

        return $estatePropertyType ? $estatePropertyType->properties()->unallocated()->get() : collect([]);

    }
}
