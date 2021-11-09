<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Clients\Edit;
use App\Http\Livewire\Clients\Show;
use App\Http\Livewire\Clients\Index;
use App\Http\Livewire\Clients\Store;
use App\Http\Livewire\Clients\Create;
use App\Http\Livewire\Clients\Update;
use App\Http\Livewire\Users\EditUser;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Clients\Destroy;
use App\Http\Livewire\Staff\EditStaff;
use App\Http\Livewire\Staff\ListStaff;
use App\Http\Livewire\Users\ListUsers;
use App\Http\Livewire\Users\CreateUser;
use App\Http\Livewire\Settings\Settings;
use App\Http\Livewire\Staff\CreateStaff;
use App\Http\Livewire\Estates\EditEstate;
use App\Http\Livewire\PaymentPlans\Plans;
use App\Http\Livewire\Clients\AddProperty;
use App\Http\Livewire\Estates\ListEstates;
use App\Http\Livewire\Search\SearchResult;
use App\Http\Livewire\Estates\CreateEstate;
use App\Http\Livewire\PaymentPlans\EditPlan;
use App\Http\Livewire\Settings\EditSettings;
use App\Http\Livewire\PaymentPlans\CreatePlan;
use App\Http\Livewire\EstatePropertType\ShowClients;
use App\Http\Livewire\PropertyTypes\EditPropertyType;
use App\Http\Livewire\PropertyTypes\ShowPropertyType;
use App\Http\Livewire\Transactions\TransactionsIndex;
use App\Http\Livewire\Transactions\TransactionsStore;
use App\Http\Livewire\PropertyTypes\ListPropertyTypes;
use App\Http\Livewire\Transactions\TransactionsCreate;
use App\Http\Livewire\PropertyTypes\CreatePropertyType;

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

Route::get('/', function () {
    return redirect('dashboard');
})->name('home');

Route::group(['middleware' => ['auth']],  function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
});


Route::group(['middleware' => ['auth', 'role:staff']],  function () {

    // payments
    Route::get('transactions', TransactionsIndex::class)->name('transactions.index');
    Route::get('transactions/create/{client}', TransactionsCreate::class)->name('transactions.create');
    Route::post('transactions', TransactionsStore::class)->name('transactions.store');

    // estates
    Route::get('estates', ListEstates::class)->name('estates.index');
    Route::get('estates/create', CreateEstate::class)->name('estates.create');
    Route::get('estates/{estate}/edit', EditEstate::class)->name('estates.edit');

    // property-types
    Route::get('property-types', ListPropertyTypes::class)->name('property-types.index');
    Route::get('property-types/create', CreatePropertyType::class)->name('property-types.create');
    Route::get('property-types/{propertytype}/edit', EditPropertyType::class)->name('property-types.edit');
    Route::get('property-types/{propertyType}/show', ShowPropertyType::class)->name('property-types.show');

    // estate property-type
    Route::get('estate-property-type/{estate}/{propertyType}/clients', ShowClients::class)->name('estate-property-type.clients');

    // payment-plans
    Route::get('payment-plans', Plans::class)->name('payment-plans.index');
    Route::get('payment-plans/create', CreatePlan::class)->name('payment-plans.create');
    Route::get('payment-plans/{paymentPlan}/edit', EditPlan::class)->name('payment-plans.edit');

    // settings
    Route::get('settings', Settings::class)->name('settings.index');
    Route::get('settings/edit', EditSettings::class)->name('settings.edit');

    // staff
    Route::get('staff', ListStaff::class)->name('staff.index');
    Route::get('staff/create', CreateStaff::class)->name('staff.create');
    Route::get('staff/{staff}/edit', EditStaff::class)->name('staff.edit');

    // users
    Route::get('users', ListUsers::class)->name('users.index');
    Route::get('users/create', CreateUser::class)->name('users.create');
    Route::get('users/{staff}/edit', EditUser::class)->name('users.edit');

    // search
    Route::get('search/result/{query}', SearchResult::class)->name('search.result');

});



Route::group(['middleware' => ['auth', 'role:staff|client']],  function () {

    // clients
    Route::get('clients', Index::class)->name('clients.index');
    Route::get('clients/create', Create::class)->name('clients.create');
    Route::post('clients', Store::class)->name('clients.store');
    Route::get('clients/{client}/show', Show::class)->name('clients.show');
    Route::get('clients/{client}/edit', Edit::class)->name('clients.edit');
    Route::put('clients', Update::class)->name('clients.update');
    Route::delete('clients', Destroy::class)->name('clients.destroy');
    Route::get('clients/{client}/add-property', AddProperty::class)->name('clients.add-property');

});

//routes
require __DIR__.'/auth.php';

