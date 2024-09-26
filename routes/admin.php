<?php
use App\Http\Controllers\Admin as Admin;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['admin']], function () {

    Route::resource('supports', ADMIN\SupportController::class);
    Route::post('supports/get-ticket', [ADMIN\SupportController::class, 'getSupport'])->name('supports.get-ticket');
    Route::post('supports/update-status', [ADMIN\SupportController::class, 'updateStatus'])->name('supports.update-status');
    Route::post('supports/reply/{support}', [ADMIN\SupportController::class, 'reply'])->name('supports.reply');
    Route::post('supportInfo', [ADMIN\SupportController::class, 'getSupportData'])->name('support.info');
    Route::post('supportstatus', [ADMIN\SupportController::class, 'supportStatus'])->name('support.status');

});
