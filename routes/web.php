<?php

use App\Http\Controllers\ContactsController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/'], function() {
    Route::get('/', function() { return view('contacts_form'); });
    Route::get('get-contacts', [ContactsController::class, 'getContacts']);
    Route::get('remove/{user_id}', [ContactsController::class, 'removeContact']);
    Route::post('update-contacts', [ContactsController::class, 'updateContacts']);
});