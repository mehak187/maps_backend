<?php
use App\Http\Controllers\adminController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['middleware' => ['adminMiddleware']],function(){
    Route::prefix('admin')->group(function(){
        Route::controller(adminController::class)->group(function(){
            Route::get('dashboard','dashboard')->name('admin.dashboard');
            Route::get('map/{id}','map')->name('map');
        });
    });
});


Route::controller(userController::class)->group(function(){
    Route::get('/','map')->name('map');
    Route::post('publishsite', 'publishsite')->name('publishsite');

});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');