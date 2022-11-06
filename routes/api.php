<?php

use App\Http\Controllers\Api\TicketApiController;
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

Route::middleware('login.proxy')
    ->post('user/login', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

Route::get('/tickets/open', [TicketApiController::class, 'getOpenTickets'])
    ->name('open-tickets');

Route::get('/tickets/closed', [TicketApiController::class, 'getClosedTickets'])
    ->name('closed-tickets');

Route::get('/users/{email}/tickets', [TicketApiController::class, 'getTicketsByEmail'])
    ->name('users-tickets');

Route::get('/stats', [TicketApiController::class, 'getStats'])
    ->name('stats');
