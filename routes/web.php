<?php

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

Route::get('/', function () {
    return [
        'website' => 'api.markidea.ma',
        'version' => '1.0.0',
        'author' => 'Markidea',
        'email' => 'contact@markidea.ma',
        'description' => 'Markidea API',
    ];
});
