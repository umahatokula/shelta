<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\PaymentPlan;
use App\Models\Transaction;
use App\Models\EstatePropertyType;
use App\Models\PropertyTypePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

    protected $dates = ['date_of_first_payment'];

    protected $fillable = ['estate_property_type_id', 'unique_number', 'client_id', 'payment_plan_id', 'date_of_first_payment'];

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
        return Transaction::where(['property_id' => $this->client->id, 'property_id' => $this->id])->isApproved()->sum('amount');
    }

    /**
     * lastPayment
     *
     * @return void
     */
    public function lastPayment() {
        return Transaction::where(['property_id' => $this->client->id, 'property_id' => $this->id])->latest('id')->first();
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

        $nextDueDate = Carbon::today()->addMonth();

        $day = $this->date_of_first_payment->day;
        $month = $nextDueDate->month;
        $year = $nextDueDate->year;

        return Carbon::parse($month.'/'.$day.'/'.$year);
    }

    /**
     * getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue
     *
     * @return void
     */
    public function getDueDateBasedOnNumberOfDaysBeforeActualPaymentisDue($number_of_days_before_due_date) {

        $nextDueDate = Carbon::today()->addDays($number_of_days_before_due_date);

        $day = $nextDueDate->day;
        $month = $nextDueDate->month;
        $year = $nextDueDate->year;

        return Carbon::parse($month.'/'.$day.'/'.$year);
    }
    
    /**
     * Get Properties Due For Reminder based on the supplied number of days
     *
     * @param  mixed $number_of_days_before_due_date
     * @param  mixed $estatePropertyTypePrice
     * @return void
     */
    public function getPropertiesDueForReminder($number_of_days_before_due_date, $estatePropertyTypePrice) {

      $nextDueDate = Carbon::today()->addDays($number_of_days_before_due_date);

      return $this->with('client')
          ->whereNotNull('client_id')
          ->whereNotNull('date_of_first_payment')
          ->get()
          ->filter(function ($property) use($nextDueDate, $estatePropertyTypePrice) {

              $day = 28;
              if ($property->date_of_first_payment->day < 28) {
                  $day = $property->date_of_first_payment->day;
              }

              $dueDate = 28;
              if ($nextDueDate->day < 28) {
                  $dueDate = $nextDueDate->day;
              }

              $property_type_prices = $estatePropertyTypePrice->filter(function($estatePropertyTypePrice) use($property) {
                  return $estatePropertyTypePrice->estate_property_type_id == $property->estate_property_type_id && $estatePropertyTypePrice->payment_plan_id == $property->payment_plan_id;
              })->first();

              if ($property_type_prices) {
                $propertyPrice = $property_type_prices->propertyPrice->price;
              }

              return ($day == $dueDate) && $property->transactionTotal() < $propertyPrice;
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
}
