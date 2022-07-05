<?php

/*
|--------------------------------------------------------------------------
| Export Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Export routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "export" middleware group. Now create something great!
|
*/

use App\User;

Route::get('/', function () {
    dd('Welcome to Export routes.');
});

Route::get('/me', function () {
    $headers = [
        'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
        'Content-type'        => 'text/csv',
        'Content-Disposition' => 'attachment; filename=galleries.csv',
        'Expires'             => '0',
        'Pragma'              => 'public'
    ];
    $list = User::all()->toArray();

    # add headers for each column in the CSV download
    array_unshift($list, array_keys($list[0]));
    $callback = function () use ($list) {
        $FH = fopen('php://output', 'w');
        foreach ($list as $row) {
            fputcsv($FH, $row);
        }
        fclose($FH);
    };
    return response()->stream($callback, 200, $headers);
});
