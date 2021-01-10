<?php

use App\Http\Controllers\ContactsController;
use App\Models\User;
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

Route::get('/', function() { 
    User::firstOrCreate(
        ['email' => 'admin@contactsapp.com'],
        ['first_name' => 'admin', 'last_name' => 'admin', 'role' => 'admin', 'password' => bcrypt('admin123')]
    );
    return view('contacts_form'); 
});
Route::get('get-contacts', [ContactsController::class, 'getContacts']);

Route::group(['prefix' => '/', 'middleware' => ['isAdmin']], function() {
    Route::get('remove/{user_id}', [ContactsController::class, 'removeContact']);
    Route::post('update-contacts', [ContactsController::class, 'updateContacts']);
});

require __DIR__.'/auth.php';
