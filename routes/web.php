<?php

use App\Models\PaymentDefaultSetting;
use Carbon\Carbon;
use App\Helpers\Helpers;
use App\Models\Property;
use App\Services\Services;
use App\Models\Transaction;
use App\Models\PaymentDefault;
use App\Mail\PaymentMadeMailable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\PaymentReminderSetting;
use App\Models\EstatePropertyTypePrice;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SignupController;
use App\Http\Livewire\Clients\AddProperty;
use App\Mail\ClientAccountCreatedMailable;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EstatesController;
use App\Http\Controllers\ImportsController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiesController;
use App\Http\Middleware\EnsurePasswordChanged;
use App\Http\Controllers\ParcelationController;
use App\Http\Controllers\PaymentPlansController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\PropertyPriceController;
use App\Http\Controllers\PropertyTypesController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\PaymentDetaultController;
use App\Notifications\PaymentReminderNotification;
use App\Http\Controllers\EstatePropertyTypeController;
use Zeevx\LaraTermii\LaraTermii;

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
    return redirect()->route('dashboard');
});

Route::get('/home', function () {

    return redirect()->route('dashboard');

})->name('home')->middleware('auth');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::prefix('admin')->middleware(['auth', '2fa'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    // clients
    Route::get('clients/{client}/sendMail', [ClientsController::class, 'sendMail'])->name('clients.sendMail');
    Route::post('clients/sendMail/post', [ClientsController::class, 'sendMailPost'])->name('clients.sendMail.post');
    Route::get('clients/{client}/add-property', [ClientsController::class, 'addProperty'])->name('clients.add-property');
    Route::get('clients/{client}/reset-password', [ClientsController::class, 'resetPassword'])->name('clients.resetPassword');
    Route::post('clients/reset-password-post', [ClientsController::class, 'resetPasswordPost'])->name('clients.resetPasswordPost');
    Route::resource('clients', ClientsController::class);

    // transactions
    Route::get('transactions/{transaction}/process', [TransactionsController::class, 'process'])->name('transactions.process');
    Route::post('transactions/processStore', [TransactionsController::class, 'processStore'])->name('transactions.processStore');
    Route::get('transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create/{client}', [TransactionsController::class, 'create'])->name('transactions.create');
    Route::post('transactions', [TransactionsController::class, 'index'])->name('transactions.store');
    Route::get('transactions/edit/{client}/{transaction}', [TransactionsController::class, 'edit'])->name('transactions.edit');
    Route::get('transactions/{transaction}', [TransactionsController::class, 'show'])->name('transactions.show');

    // properties
    Route::get('properties/export', [PropertiesController::class, 'export'])->name('properties.export');
    Route::resource('properties', PropertiesController::class);

    // estates
    // Route::get('estates/add-property-price', [EstatesController::class, 'addPropertyPrice'])->name('estates.add-property-price');
    // Route::post('estates/add-property-price', [EstatesController::class, 'addPropertyPriceStore'])->name('estates.add-property-price.store');
    Route::resource('estates', EstatesController::class);

    // property-types
    Route::resource('property-types', PropertyTypesController::class);

    // estate property-type
    Route::get('estate-property-type/{estate}/{propertyType}/csv', [EstatePropertyTypeController::class, 'csv'])->name('estate-property-type.csv');
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

    // Auth
    Route::get('password/change', [PasswordController::class, 'showChangePasswordFormStaff'])->name('password.change');
    Route::post('password/change', [PasswordController::class, 'changePassword'])->name('password.change.store');

    // payment-defaults
    Route::get('payment-defaults/{unique_number}/{client_id}/pay', [PaymentDetaultController::class, 'showPaymentForm'])->name('payment-defaults.pay');
    Route::get('payment-defaults', [PaymentDetaultController::class, 'index'])->name('payment-defaults.index');
    Route::get('payment-defaults/pdf/{date_from}/{date_to}', [PaymentDetaultController::class, 'pdf'])->name('payment-defaults.pdf');
    Route::get('payment-defaults/csv/{date_from}/{date_to}', [PaymentDetaultController::class, 'csv'])->name('payment-defaults.csv');
});

// ======================================================================
//
//                          FRONTEND
//
// ======================================================================

Route::name('frontend.')->middleware(['auth', 'role:client', '2fa', 'password_changed'])->group(function () {

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

    // plot selection
    Route::get('parcelation/{plot_unique_number}/pay', [ParcelationController::class, 'pay'])->name('parcelation.pay');
    Route::get('parcelation/{estate_slug}', [ParcelationController::class, 'selectPlot'])->name('parcelation.select');

    // Auth
    Route::get('password/change', [PasswordController::class, 'showChangePasswordForm'])->name('password.change')->withoutMiddleware([EnsurePasswordChanged::class]);
    Route::post('password/change', [PasswordController::class, 'changePassword'])->name('password.change.store')->withoutMiddleware([EnsurePasswordChanged::class]);


});


//=======================================================================
//
//                          PUBLIC ROUTES
//
//=======================================================================

Route::get('subscribe', [SignupController::class, 'signup'])->name('signUp');
//Route::post('signup', [SignupController::class, 'signUpPost'])->name('signUpPost');
Route::get('signup-preview/{client}/{estateId}/{propertyTypeId}/{paymentPlanId}', [SignupController::class, 'preview'])->name('signUpPreview');
Route::post('signup-preview/{client}/{estateId}/{propertyTypeId}/{paymentPlanId}', [SignupController::class, 'signUpPreviewPost'])->name('signUpPreviewPost');







Route::get('/resetpasswords', function () {
    dd('sdsdsds');


    // create user accounts for clients who dont have a user account
    $clients = App\Models\Client::pluck('email');
    $users = App\Models\User::pluck('email');

    $diff = $clients->diff($users);
    // dd($diff);

    foreach ($diff as $email) {

        $client = App\Models\Client::where('email', $email)->first();

        $user = App\Models\User::Create(
            [
                'name'      => $client->sname.' '.$client->onames,
                'client_id' => $client->id,
                'email' => $client->email,
                'password'  => \Hash::make('12345678'),
            ]
        );
    }

    // ==================================================================================
    $password = '12345678';
    $users = App\Models\User::whereNull('password_change_date')->whereNull('staff_id')->get();
    // dd($users);

    foreach ($users as $user) {

        $user->password  = \Hash::make($password);
        $user->save();
        // dd($user->client);

        // assign role
        $user->assignRole('client');

        // send email
        Mail::to($user->client->email)->send(new ClientAccountCreatedMailable($user->client, $password));

    }

    echo ('done');

});

Route::get('/mailable', function () {
    $transaction = Transaction::findOrFail(1);

    return new App\Mail\PaymentMadeMailable($transaction);
});

Route::get('/test', function() {

    // $response = Helpers::sendSMSMessage('+2348033312448', 'Hi Umaha');
    // dd($response);

});
