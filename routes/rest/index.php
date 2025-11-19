<?php


use Illuminate\Support\Facades\Route;


Route::middleware('rest')->group(function () {

    require __DIR__ . '/v1.php';

});
