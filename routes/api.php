<?php

use App\Http\Controllers\LdapTestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [LdapTestController::class, 'login']);

// Route::middleware([
//     'auth.windows:api',
// ])->get('/test', [LdapTestController::class, 'test_windows_auth']);

Route::middleware([
    'cors',
])->get('/test', [LdapTestController::class, 'test_windows_auth']);
