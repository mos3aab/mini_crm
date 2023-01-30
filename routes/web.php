<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
// use DB;
require __DIR__.'/auth.php';
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
    return view('welcome');
});
Route::get('/dashboard', function () {
    $EmployeeCount = DB::table('employees')->count();
    $CompanyCount  = DB::table('companies')->count();
    
    return view('dashboard')->with(['employees'=>$EmployeeCount,'companies'=>$CompanyCount]);
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Employee Routes
Route::middleware('auth')->group(function () {
    Route::get('/employees',   [EmployeeController::class, 'index'])->name('employees');
    Route::get('/add_emp',     [EmployeeController::class, 'create'])->name('employees.add');
    Route::post('/add_emp',    [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/edit_emp/{id}',[EmployeeController::class, 'edit'])->name('employees.edit');
    Route::post('/edit_emp',   [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/delete_emp', [EmployeeController::class, 'destroy'])->name('employees.delete');
});

// Company Routes
Route::middleware('auth')->group(function () {
    Route::get('/companies',    [CompanyController::class, 'index'])->name('companies');
    Route::get('/add_comp',     [CompanyController::class, 'create'])->name('companies.add');
    Route::post('/add_comp',    [CompanyController::class, 'store'])->name('companies.store');
    Route::get('/edit_comp/{id}',[CompanyController::class, 'edit'])->name('companies.edit');
    Route::post('/edit_comp',   [CompanyController::class, 'update'])->name('companies.update');
    Route::delete('/delete_comp', [CompanyController::class, 'destroy'])->name('companies.delete');
});