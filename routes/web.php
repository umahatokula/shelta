<?php

use App\Http\Livewire\Clients\Edit;
use App\Http\Livewire\Clients\Show;
use App\Http\Livewire\Clients\Index;
use App\Http\Livewire\Clients\Store;
use App\Http\Livewire\Clients\Create;
use App\Http\Livewire\Clients\Update;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Clients\Destroy;
use App\Http\Livewire\Users\ListUsers;
use App\Http\Livewire\Estates\EditEstate;
use App\Http\Livewire\Estates\ListEstates;
use App\Http\Livewire\Estates\CreateEstate;
use App\Http\Livewire\PropertyTypes\EditPropertyType;
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
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::group(['auth:sanctum', 'verified'],  function () {

//     Route::get('/dashboard', function () {
//         return Inertia::render('Dashboard');
//     });

// });

    // clients
    Route::get('clients', Index::class)->name('clients.index');
    Route::get('clients/create', Create::class)->name('clients.create');
    Route::post('clients', Store::class)->name('clients.store');
    Route::get('clients/{client}/show', Show::class)->name('clients.show');
    Route::get('clients/{client}/edit', Edit::class)->name('clients.edit');
    Route::put('clients', Update::class)->name('clients.update');
    Route::delete('clients', Destroy::class)->name('clients.destroy');

    // payments
    Route::get('transactions', TransactionsIndex::class)->name('transactions.index');
    Route::get('transactions/create/{client}', TransactionsCreate::class)->name('transactions.create');
    Route::post('transactions', TransactionsStore::class)->name('transactions.store');

    // estates
    Route::get('estates', ListEstates::class)->name('estates.index');
    Route::get('estates/create', CreateEstate::class)->name('estates.create');
    Route::get('estates/{estate}/edit', EditEstate::class)->name('estates.edit');

    // property-groups
    Route::get('property-types', ListPropertyTypes::class)->name('property-types.index');
    Route::get('property-types/create', CreatePropertyType::class)->name('property-types.create');
    Route::get('property-types/{propertytype}/edit', EditPropertyType::class)->name('property-types.edit');

    // users
    Route::get('user', ListUsers::class)->name('property-types.index');

