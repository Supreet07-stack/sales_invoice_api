<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesInvoiceController;

Route::post('/sales-invoices', [SalesInvoiceController::class, 'create']);
Route::post('/test-api', function () {
    return response()->json(['message' => 'success'], 200);
});
