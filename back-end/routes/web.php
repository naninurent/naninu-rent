<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServicesController;
use App\Models\Invoice;
use App\Models\Order;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/', [CarController::class, 'index']);

Route::get('naninunet', [AuthController::class, 'login']);
Route::post('naninunet', [AuthController::class, 'authenticate']);
Route::get('logout', [AuthController::class, 'logout']);

//Cars Routes
Route::get('cars', [CarController::class, 'index']);
Route::get('cars/create', [CarController::class, 'create']);
Route::post('cars', [CarController::class, 'store']);
Route::get('cars/{id}/edit', [CarController::class, 'edit']);
Route::patch('cars/{id}', [CarController::class, 'update']);
Route::get('manage_cars', [CarController::class, 'manage_cars']);
Route::get('cars/search', [CarController::class, 'search_cars']);
Route::get('cars-collection/search', [CarController::class, 'search_cars_collection']);
Route::delete('cars/{id}', [CarController::class, 'destroy']);

//Order Routes
Route::get('order/{id}', [OrderController::class, 'create']);
Route::post('order/{id}', [OrderController::class, 'store']);
Route::get('confirm_order/{id}', [OrderController::class, 'confirm_order']);
Route::get('store_confirm_order/{id}', [OrderController::class, 'store_confirm_order'])->name("store_confirm_order");
Route::get('status_order/{id}', [OrderController::class, 'status_order'])->name("status_order");
Route::get('manage_orders', [OrderController::class, 'manage_orders']);
Route::get('order/{id}/edit', [OrderController::class, 'edit']);
Route::patch('order/{id}', [OrderController::class, 'update']);
Route::post('search-order', [OrderController::class, 'search_order']);
Route::get('orders/search', [OrderController::class, 'orders_search']);
Route::delete('order/{id}', [OrderController::class, 'destroy']);

// customer
Route::get('manage_customers', [CustomerController::class,'index']);
Route::get('customer/create', [CustomerController::class,'create']);
Route::post('customers',[CustomerController::class,'store']);
Route::get('customer/{id}',[CustomerController::class,'show']);
Route::get('customer/{id}/edit', [CustomerController::class,'edit']);
Route::patch('customer/{id}',[CustomerController::class,'update']);
Route::post('registCustomer',[CustomerController::class,'register']);
Route::delete('customer/{id}',[CustomerController::class,'destroy']);

// invoice
Route::get('invoices',[InvoiceController::class,'index']);
Route::get('create_invoice/{id}',[InvoiceController::class,'create']);
Route::get('invoice/{id}/edit',[InvoiceController::class,'edit']);
Route::patch('invoice/{id}',[InvoiceController::class,'update']);
Route::get('print_invoice/{id}',[InvoiceController::class,'cetak']);
Route::post('create_invoice',[InvoiceController::class,'store']);
Route::delete('invoice/{id}',[InvoiceController::class,'destroy']);

// services

Route::get('services',[ServicesController::class,'index']);
Route::get('services/create',[ServicesController::class,'create']);
Route::post('services', [ServicesController::class,'store']);
Route::get('service/{id}/edit', [ServicesController::class,'edit']);
Route::patch('service/{id}', [ServicesController::class,'update']);
Route::delete('service/{id}', [ServicesController::class, 'destroy']);

// Cetak PDF
Route::get('cars/cetak_data_mobil', [CarController::class, 'cetak_data_mobil']);
Route::get('orders/cetak_transaksi', [OrderController::class, 'cetak_transaksi']);
Route::get('status_order/cetak/{id}', [OrderController::class, 'cetak_bukti_bayar']);
Route::get('orders/cetak_pdf', [OrderController::class, 'cetak_transaksi']);
Route::get('orders/cetak_kwitansi/{id}', [OrderController::class, 'cetak_kwitansi']);
Route::get('orders/cetak_checklist/{id}', [OrderController::class, 'cetak_checklist']);
