<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;
use App\Http\Livewire\TeachersData;
use App\Http\Livewire\ClarkData;
use App\Http\Livewire\AccountantData;
use App\Http\Livewire\EmployeesData;


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

Route::get('/', Home::class)->name('home');
Route::get('/techersdata', TeachersData::class)->name('TeachersData');
Route::get('/clarkdata', ClarkData::class)->name('ClarkData');
Route::get('/accountantdata', AccountantData::class)->name('AccountantData');
Route::get('/employeedata', EmployeesData::class)->name('EmployeeData');