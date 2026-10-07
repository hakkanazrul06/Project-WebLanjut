<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'success' => true,
        'message' => 'Laravel REST API is running successfully',
        'version' => app()->version(),
        'endpoints' => [
            'products' => url('/products'),
            'register' => url('/register'),
            'login' => url('/login'),
        ],
    ]);
});
