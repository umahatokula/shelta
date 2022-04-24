<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Client;
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
        return Transaction::where(['client_id' => $this->client->id, 'property_id' => $this->id])->isApproved()->latest('instalment_date')->first();
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
     * client
     *
     * @return void
     */
    public function transactionTotal() {
        return $this->hasMany(Transaction::class)->isApproved()->sum('amount');
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

        // $nextDueDate = Carbon::today()->addMonth();
        $nextDueDate = Carbon::parse($this->lastInstalmentPayment()->instalment_date)->addMonth();

        if ($nextDueDate ->isPast()) {
            $nextDueDate = Carbon::today();
        }

        // ensure due date is not greater than 28. This is because Feb has 28 days in leap years so we use this minimum number of days as our payment cycle.
        $day = 28;
        if ($this->date_of_first_payment->day < 28) {
            $day = $this->date_of_first_payment->day;
        }

        $month = $nextDueDate->month;
        $year = $nextDueDate->year;

        $dueDate = Carbon::parse($month.'/'.$day.'/'.$year);

        // ensure that due date is within current month if monthly payment day is greater than or equal to day of current month
        if ($day >= Carbon::today()->day) {
            // $dueDate = $dueDate->subMonth();
        }

        return $dueDate;
    }

    /**
     * getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue
     *
     * @return void
     */
    public function getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue($number_of_days_to_due_date) {

        $nextDueDate = Carbon::today()->addDays($number_of_days_to_due_date);

        $day = $nextDueDate->day;
        $month = $nextDueDate->month;
        $year = $nextDueDate->year;

        return Carbon::parse($month.'/'.$day.'/'.$year);
    }

    /**
     * Get Properties Due For Reminder based on the supplied number of days
     *
     * @param  mixed $number_of_days_to_due_date
     * @param  mixed $estatePropertyTypePrice
     * @return void
     */
    public function getPropertiesDueForReminder($number_of_days_to_due_date) {

      $estatePropertyTypePrice = EstatePropertyTypePrice::all();

      $nextDueDate = Carbon::today()->addDays($number_of_days_to_due_date);

      return $this->with('client')
          ->whereNotNull('client_id')
          ->whereNotNull('date_of_first_payment')
          ->get()
          ->filter(function ($property) use ($nextDueDate, $estatePropertyTypePrice) {

            //   $day = 28;
            //   if ($property->date_of_first_payment->day < 28) {
            //       $day = $property->date_of_first_payment->day;
            //   }

            //   $dueDate = 28;
            //   if ($nextDueDate->day < 28) {
            //       $dueDate = $nextDueDate->day;
            //   }

            //   $property_type_prices = $estatePropertyTypePrice->filter(function($estatePropertyTypePrice) use($property) {
            //       return $estatePropertyTypePrice->estate_property_type_id == $property->estate_property_type_id && $estatePropertyTypePrice->payment_plan_id == $property->payment_plan_id;
            //   })->first();

            //   if ($property_type_prices) {
            //     $propertyPrice = $property_type_prices->propertyPrice->price;
            //   }

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
     * @return void
     */
    public function getMonthlyPaymentAmount() {

        $paymentPlanAndPrice = $this->getPaymentPlanAndPrice();

        $paymentPlanNumberOfMonths = $paymentPlanAndPrice->paymentPlan->number_of_months;
        $price = $paymentPlanAndPrice->propertyPrice->price;

        if ($paymentPlanNumberOfMonths == 0) {
            return 0;
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
}
