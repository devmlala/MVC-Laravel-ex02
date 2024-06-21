<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

echo "oi galera";

    return view('welcome');
});


Route::get('/sistemasfflch', function () {

    echo "Sistema fflch";
    
        return view('welcome');
    });

