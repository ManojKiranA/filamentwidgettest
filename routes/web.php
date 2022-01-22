<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
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
    return view('welcome');
});

Route::get('hello', function () {
    return
    User::query()
    ->toBase()
    ->selectRaw('YEAR(date_of_birth) as year_of_birth')
    ->addSelect(DB::raw('count(*) as total_no_of_users'))
    ->groupBy('year_of_birth')
    ->pluck('total_no_of_users', 'year_of_birth');
    
});
