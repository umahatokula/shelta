<?php

namespace App\Http\Livewire\Settings;

use App\Models\PaymentDefaulterGroupSetting;
use App\Models\PaymentDefaultSetting;
use Livewire\Component;
use App\Models\PaymentReminderSetting;

class PaymentReminders extends Component
{
    public $reminders = [];
    public $addedReminders = [];
    public $defaulterGroups = [];
    public $addedDefaulterGroups = [];
    public $default_percentage = 0;

    /**
     * mount
     *
     * @return void
     */
    public function mount() {

        $this->reminders = $this->addedReminders = PaymentReminderSetting::all()->toArray();
        $this->defaulterGroups = $this->addedDefaulterGroups = PaymentDefaulterGroupSetting::all()->toArray();

        $this->default_percentage = PaymentDefaultSetting::first() ? PaymentDefaultSetting::first()->default_percentage : 0;
    }

    /**
     * addProperty
     *
     * @return void
     */
    public function addReminder() {
        $this->reminders[] = [
            'number_of_days_before_due_date' => '',
            'message' => '',
        ];
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
     * addProperty
     *
     * @return void
     */
    public function addDefaulterGroup() {
        $this->defaulterGroups[] = [
            'name' => '',
            'default_months' => '',
            'message' => '',
        ];
    }

    /**
     * removeProperty
     *
     * @param  mixed $index
     * @return void
     */
    public function removeDefaulterGroup($key) {
        array_splice($this->defaulterGroups, $key, 1);
        array_key_exists($key, $this->addedDefaulterGroups) ? array_splice($this->addedDefaulterGroups, $key, 1) : null;
    }


    /**
     * save
     *
     * @return void
     */
    public function save() {

//        $this->validate([
//            'addedReminder.*.number_of_days_before_due_date' => 'required|numeric',
//            'addedReminder.*.message' => 'required',
//            'addedReminder.*.number_of_days_before_due_date' => 'distinct',
//        ]);

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


    /**
     * save
     *
     * @return void
     */
    public function saveDefaultersGroup() {

//        $this->validate([
//            'addedDefaulterGroups.*.name' => 'required|numeric',
//            'addedDefaulterGroups.*.default_months' => 'required',
//            'addedDefaulterGroups.*.message' => 'required|max: 150',
//        ]);

        PaymentDefaulterGroupSetting::truncate();

        foreach($this->addedDefaulterGroups as $group) {

            PaymentDefaulterGroupSetting::create([
                'name' => $group['name'],
                'default_months' => $group['default_months'],
                'message' => $group['message']
            ]);
        }

        // session()->flash('message', 'Estate successfully added.');
        $this->dispatchBrowserEvent('showToastr', ['type' => 'success', 'message' => 'Defaulters Groups set successfully.']);

        redirect()->route('settings.payment-reminders');

    }

    /**
     * @return void
     */
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
