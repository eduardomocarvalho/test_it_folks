<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentaryController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\TicketController;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/get-tickets', [TicketController::class, 'index']);
    Route::post('/send-ticket', [TicketController::class, 'store']);
    Route::put('/send-ticket/{id}', [TicketController::class, 'update']);
    Route::put('/cancel-ticket/{id}', [TicketController::class, 'cancel_ticket']);
    Route::put('/close-ticket/{id}', [TicketController::class, 'close_ticket']);
    Route::put('/accept-ticket/{id}', [TicketController::class, 'accept_ticket']);

    Route::get('/get-commentaries', [CommentaryController::class, 'index']);
    Route::post('/save-commentary', [CommentaryController::class, 'store']);

    Route::get('/get-categories', [CategoryController::class, 'index']);

    Route::post('/register-user', [AuthController::class, 'register']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
