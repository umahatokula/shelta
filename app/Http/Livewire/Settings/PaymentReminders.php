<?php

namespace App\Http\Livewire\Settings;

use App\Models\PaymentDefaultSetting;
use Livewire\Component;
use App\Models\PaymentReminderSetting;

class PaymentReminders extends Component
{
    public $reminders = [];
    public $defaulterGroups = [];
    public $addedReminders = [];
    public $default_percentage = 0;

    protected $rules = [
        'addedReminder.*.number_of_days_before_due_date' => 'required|numeric',
        'addedReminder.*.message' => 'required',
        'addedReminder.*.number_of_days_before_due_date' => 'distinct',
    ];

    /**
     * mount
     *
     * @return void
     */
    public function mount() {

        $this->reminders = $this->addedReminders = PaymentReminderSetting::all()->toArray();
        $this->defaulterGroups = $this->addedDefaulterGroups = PaymentReminderSetting::all()->toArray();

        $this->default_percentage = PaymentDefaultSetting::first() ? PaymentDefaultSetting::first()->default_percentage : 0;
    }

    /**
     * addProperty
     *
     * @return void
     */
    public function addReminder() {
        array_push($this->reminders, [
            'number_of_days_before_due_date' => '',
            'message' => '',
        ]);
    }

    /**
     * removeProperty
     *
     * @param  mixed $index
     * @return void
     */
    public function removeReminder($key) {
        array_splice($this->reminders, $key, 1);
        array_key_exists($key, $this->addedReminders) ? array_splice($this->addedReminders, $key, 1) : null;
    }


    /**
     * save
     *
     * @return void
     */
    public function save() {
        // $this->validate();

        PaymentReminderSetting::truncate();

        foreach($this->addedReminders as $reminder) {

            PaymentReminderSetting::create([
                'number_of_days_before_due_date' => $reminder['number_of_days_before_due_date'],
                'message' => $reminder['message']
            ]);
        }

        // session()->flash('message', 'Estate successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Reminders set successfully.']);

        redirect()->route('settings.payment-reminders');

    }

    public function saveDefaultPenaltyPercentage() {

        $validatedData = $this->validate([
            'default_percentage' => 'required|numeric',
        ]);

        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Payment default percentage set']);
        PaymentDefaultSetting::updateOrCreate(
            ['id' => 1],
            [
                'default_percentage' => $this->default_percentage,
            ]);
    }

    public function render()
    {
        return view('livewire.settings.payment-reminders');
    }
}
