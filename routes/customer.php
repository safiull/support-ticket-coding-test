<?php

use App\Http\Controllers\Customer as Customer;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'customer.', 'prefix' => 'customer', 'middleware' => ['customer']], function () {

    Route::resource('supports', Customer\SupportController::class);

});
