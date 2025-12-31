<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Exports\ReclamationsExport;
use App\Models\Reclamation;
use App\Http\Controllers\ReclamationsController;
use App\Http\Controllers\ReclamationController;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Auth\LoginController;
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

//Route::get('/', function () {
    //return redirect()->route('connexion');

//});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reclamations', 'ReclamationsController@index')->name('reclamations');
Route::get('/faire-reclamation', 'ReclamationController@faireReclamation')->name('faire-reclamation');
Route::get('/faireDemandeBourse', 'ReclamationController@faireDemandeBourse')->name('faireDemandeBourse');
Route::get('/formulaire', 'ReclamationController@indexe')->name('formulaire');
Route::get('/formulairesocial', 'ReclamationController@indexsocial')->name('formulairesocial');
Route::post('/UserController', 'UserController@store')->name('UserController');
Route::get('/home', function () {
    return redirect()->route('home');
});
Route::get('/connexion', function () {
    return view('connexion');
})->name('connexion');

Route::get('/export-reclamations', function(){
    return Excel::download(new ReclamationsExport, 'reclamations.xlsx');
});


Route::get("/page1",function(){
    return view("page1");
})->name("page1");
Route::get("/page2",[ReclamationController::class, 'index'])->name("page2");

Route::get("/{id}",[ReclamationController::class, 'show'])->name("reclamations.show");

Route::post("/reclamation/store",[ReclamationController::class,'store'])->name("reclamations.store");

Route::get('/login', function () {
    return view('app');
});



Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

