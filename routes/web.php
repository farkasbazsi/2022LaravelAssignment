<?php

use App\Http\Controllers\LabelController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('items.index');
});

//Route::resource('items', ItemController::class);

Route::resources([
    'labels' => LabelController::class,
    'items' => ItemController::class,
]);

Auth::routes();
