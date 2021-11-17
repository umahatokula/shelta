<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SearchController;
use App\Http\Livewire\Clients\AddProperty;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\EstatesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PropertiesController;
use App\Http\Controllers\PaymentPlansController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\PropertyTypesController;
use App\Http\Controllers\TwoFactorAuthController;
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
        return redirect()->route('frontend.dashboard');
    }

    return redirect()->route('dashboard');
    
})->name('home')->middleware('auth');


Route::prefix('admin')->middleware(['auth', 'role:staff'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // clients
    Route::get('clients/{client}/sendMail', [ClientsController::class, 'sendMail'])->name('clients.sendMail');
    Route::post('clients/sendMail/post', [ClientsController::class, 'sendMailPost'])->name('clients.sendMail.post');
    Route::get('clients/{client}/add-property', [ClientsController::class, 'addProperty'])->name('clients.add-property');
    Route::resource('clients', ClientsController::class);

    // payments
    Route::get('transactions', [TransactionsController::class, 'index'])->name('transactions.index');
    Route::get('transactions/create/{client}', [TransactionsController::class, 'create'])->name('transactions.create');
    Route::post('transactions', [TransactionsController::class, 'index'])->name('transactions.store');

    // properties
    Route::resource('properties', PropertiesController::class);

    // estates
    Route::resource('estates', EstatesController::class);

    // property-types
    Route::resource('property-types', PropertyTypesController::class);

    // estate property-type
    Route::get('estate-property-type/{estate}/{propertyType}/clients', [EstatePropertyTypeController::class, 'showClients'])->name('estate-property-type.clients');

    // payment-plans
    Route::resource('payment-plans', PaymentPlansController::class);

    // settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/edit', [SettingsController::class, 'edit'])->name('settings.edit');

    // staff
    Route::get('staff/profile', [StaffController::class, 'profile'])->name('staff.profile');
    Route::resource('staff', StaffController::class);

    // users
    Route::resource('users', UsersController::class);

    // search
    Route::get('search/result/{query}', [SearchController::class, 'result'])->name('search.result');
});

Route::name('frontend.')->middleware(['auth', 'role:client', '2fa'])->group(function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // clients
    Route::get('clients/{transaction_number}/download-reciept', [ClientsController::class, 'downloadReciept'])->name('clients.downloadReciept');
    Route::get('clients/{transaction_number}/mail-reciept', [ClientsController::class, 'mailReciept'])->name('clients.mailReciept');

    Route::get('clients/profile', [ClientsController::class, 'profile'])->name('clients.profile');
    Route::put('clients/{client}/profile', [ClientsController::class, 'profile'])->name('clients.profile.updateClientProfileRequest');
    Route::post('clients/profile/toggle2FA', [ClientsController::class, 'toggle2FA'])->name('clients.profile.toggle2FA');

    Route::get('clients/payments', [ClientsController::class, 'payments'])->name('clients.payments');
    Route::get('clients/properties', [ClientsController::class, 'properties'])->name('clients.properties');
    Route::get('clients/{client}/add-property', [ClientsController::class, 'addProperty'])->name('clients.add-property');
    Route::get('clients/{client}', [ClientsController::class, 'show'])->name('clients.show');


});


Route::get('/mailable', function () {
    $transaction = App\Models\Transaction::find(1);

    return new App\Mail\PaymentMadeMailable($transaction);
});