<?php

// routes/api.php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

/*
|---------------------------------------------------------------------------|
| API Routes                                                                |
|---------------------------------------------------------------------------|
*/

Route::get('/products-list', [ApiController::class, 'index']);
Route::delete('/delete-products/{id}', [ApiController::class, 'destroy']);