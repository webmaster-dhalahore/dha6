<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/apis.php';
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/membership.php';

Route::get('/', function () {
    return redirect('login');
});
Route::get('/test', function() {
    $password = Hash::make('dha1');
    return $password;
});


Route::view('GuestRoomBilling', 'Example.GuestRoomBilling');
Route::view('ShiftOpening', 'Example.ShiftOpening');
Route::view('Advance', 'Example.Advance');
Route::view('DayClosing', 'Example.DayClosing');
Route::view('ShiftClosing', 'Example.ShiftClosing');