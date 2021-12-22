<?php

use Carbon\Carbon;
use App\Helpers\Helpers;
use App\Models\Property;
use App\Models\PaymentDefault;
use Illuminate\Support\Facades\Route;
use App\Models\PaymentReminderSetting;
use App\Models\EstatePropertyTypePrice;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Clients\AddProperty;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EstatesController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PaymentPlansController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\PropertyPriceController;
use App\Http\Controllers\PropertyTypesController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Notifications\PaymentReminderNotification;
use App\Http\Controllers\EstatePropertyTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('clients/login', [ClientsController::class, 'login'])->name('clients.login');
Auth::routes();

Route::get('two-factor-auth', [TwoFactorAuthController::class, 'index'])->name('2fa.index')->middleware(['auth']);
Route::post('two-factor-auth', [TwoFactorAuthController::class, 'store'])->name('2fa.store')->middleware(['auth']);
Route::get('two-factor-auth/resent', [TwoFactorAuthController::class, 'resend'])->name('2fa.resend')->middleware(['auth']);

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {

    if (auth()->user()->hasRole('client')) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('dashboard');

})->name('home')->middleware('auth');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('admin')->middleware(['auth', 'role:staff'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // clients
    Route::get('clients/{client}/sendMail', [ClientsController::class, 'sendMail'])->name('clients.sendMail');
    Route::post('clients/sendMail/post', [ClientsController::class, 'sendMailPost'])->name('clients.sendMail.post');
    Route::get('clients/{client}/add-property', [ClientsController::class, 'addProperty'])->name('clients.add-property');
    Route::resource('clients', ClientsController::class);

    // transactions
    Route::get('transactions/{transaction}/process', [TransactionsController::class, 'process'])->name('transactions.process');
    Route::post('transactions/processStore', [TransactionsController::class, 'processStore'])->name('transactions.processStore');
    Route::get('transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create/{client}', [TransactionsController::class, 'create'])->name('transactions.create');
    Route::post('transactions', [TransactionsController::class, 'index'])->name('transactions.store');
    Route::get('transactions/{transaction}', [TransactionsController::class, 'show'])->name('transactions.show');

    // properties
    Route::resource('properties', PropertiesController::class);

    // estates
    // Route::get('estates/add-property-price', [EstatesController::class, 'addPropertyPrice'])->name('estates.add-property-price');
    // Route::post('estates/add-property-price', [EstatesController::class, 'addPropertyPriceStore'])->name('estates.add-property-price.store');
    Route::resource('estates', EstatesController::class);

    // property-types
    Route::resource('property-types', PropertyTypesController::class);

    // estate property-type
    Route::get('estate-property-type/{estate}/{propertyType}/clients/send-notification', [EstatePropertyTypeController::class, 'sendNotification'])->name('estate-property-type.clients.send-notification');
    Route::post('estate-property-type/clients/send-notification', [EstatePropertyTypeController::class, 'sendNotificationStore'])->name('estate-property-type.clients.send-notification.store');
    Route::get('estate-property-type/{estate}/{propertyType}/clients', [EstatePropertyTypeController::class, 'showClients'])->name('estate-property-type.clients');

    // payment-plans
    Route::resource('payment-plans', PaymentPlansController::class);

    // property prices
    Route::resource('property-prices', PropertyPriceController::class);

    // settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::get('settings/payment-reminders', [SettingsController::class, 'paymentReminders'])->name('settings.payment-reminders');

    // staff
    Route::get('staff/profile', [StaffController::class, 'profile'])->name('staff.profile');
    Route::resource('staff', StaffController::class);

    // users
    Route::resource('users', UsersController::class);

    // search
    Route::get('search/result/{query}', [SearchController::class, 'result'])->name('search.result');

    // imports
    Route::get('imports/clients', [ImportsController::class, 'importClients'])->name('imports.clients');
    Route::post('imports/clients', [ImportsController::class, 'importClientsStore'])->name('imports.clients.store');
    Route::get('imports/property', [ImportsController::class, 'importProperty'])->name('imports.property');
    Route::post('imports/property', [ImportsController::class, 'importPropertyStore'])->name('imports.property.store');

    // transactions
    // Route::resource('transactions', TransactionsController::class);
});

// ======================================================================
//
//                          FRONTEND
//
// ======================================================================

Route::name('frontend.')->middleware(['auth', 'role:client'])->group(function () {

    Route::get('client/dashboard', [DashboardController::class, 'clientDashboard'])->name('dashboard');

    // clients
    Route::get('clients/{transaction_number}/download-reciept', [ClientsController::class, 'downloadReciept'])->name('clients.downloadReciept');
    Route::get('clients/{transaction_number}/mail-reciept', [ClientsController::class, 'mailReciept'])->name('clients.mailReciept');

    Route::get('clients/profile', [ClientsController::class, 'profile'])->name('clients.profile');
    Route::post('clients/profile', [ClientsController::class, 'updateClientProfileRequest'])->name('clients.profile.updateClientProfileRequest');
    Route::get('clients/security', [ClientsController::class, 'security'])->name('clients.security');
    Route::post('clients/profile/toggle2FA', [ClientsController::class, 'toggle2FA'])->name('clients.profile.toggle2FA');

    Route::get('clients/payments', [ClientsController::class, 'payments'])->name('clients.payments');
    Route::get('clients/properties', [ClientsController::class, 'properties'])->name('clients.properties');
    Route::get('clients/{client}/add-property', [ClientsController::class, 'addProperty'])->name('clients.add-property');
    Route::get('clients/{client}', [ClientsController::class, 'show'])->name('clients.show');

    // transactions
    Route::get('transactions/create/record', [TransactionsController::class, 'frontendRecordTransaction'])->name('transactions.record');
    Route::get('transactions/create/record/store', [TransactionsController::class, 'frontendRecordTransactionStore'])->name('transactions.record.store');
    Route::get('transactions/create/online', [TransactionsController::class, 'frontendOnlineTransaction'])->name('transactions.online');
    Route::get('transactions/create/online/store', [TransactionsController::class, 'frontendOnlineTransactionStore'])->name('transactions.online.store');


});

Route::get('/mailable', function () {

    // $pastDueProperties = Property::where(function($query) {
    //     return $query->whereDay('date_of_first_payment', '=', Carbon::yesterday()->format('d'));
    // })->get();

    $pastDueProperties = Property::where(function($query) {
        return $query->whereDay('date_of_first_payment', '=', Carbon::yesterday()->format('d'));
    })
    ->whereNotIn('id', function ($query) {
        $query->select('transactions.property_id') // get previous day's transactions
            ->from('transactions')
            ->whereDate('transactions.date', '=', Carbon::yesterday());
    })->get();

    $inserts = [];
    foreach ($pastDueProperties as $property) {

        $monthlyAmount = $property->getMonthlyPaymentAmount();

        if ($monthlyAmount > 0) {
            $inserts[] = [
                'client_id'      => $property->client_id,
                'property_id'    => $property->id,
                'default_amount' => $monthlyAmount,
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ];
        }
        
    }

    $res = PaymentDefault::insert($inserts);
    dd($res);

});

Route::get('/test', 'App\Cron\SendMonthlyPaymentReminders');
