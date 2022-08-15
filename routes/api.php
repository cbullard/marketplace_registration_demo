<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SellerAppFieldsController;
use App\Http\Controllers\SellersController;

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

    Route::prefix('sellers')->group(function () {
        /**
         * Retrieve all infomation to populate dropdowns
         */
        Route::get('/get-drop-downs',[SellerAppFieldsController::class, 'index'])->name('getDropDownFields');

        /**
         * Check to see if the portfolio was already submitted
         */
        Route::get('/check-existing-portfolio',[SellersController::class, 'checkExistingPortfolio'])->name('checkPortfolio');

        /**
         * Create new seller application
         */
        Route::post('/seller',[SellersController::class, 'create'])->name('submitSellerApplication');

    });

