<?php

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

Route::get('/', function () {
    return redirect(route('short-urls.index'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('/short-urls', ShortUrlController::class);
Route::get('/{code}', ['as' => 's.show', 'uses' => 'ShortUrlController@show']);

require __DIR__.'/auth.php';
