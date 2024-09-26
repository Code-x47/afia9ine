<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\productController;

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

Route::get('/', function () {
    return view('home.index');
});




//Route::view("/order","home.order");
Route::view("/proReg","home.productReg");
Route::view("/checkout","home.checkout");

Route::view("/userReg","home.userReg");
Route::view("/userLogin","home.userLogin");


Route::Post("/reg",[userController::class,"Create"]);
Route::Post("/login",[userController::class,"Login"]);
Route::get("/logout",[userController::class,"Logout"]);
Route::Post("/proReg",[productController::class,"createProduct"]);


Route::get("index",[productController::class,"viewProduct"]);

Route::POST("add2cart/{id}",[productController::class,"add2cart"]);
Route::get("cart",[productController::class,"cartDetails"]);
Route::get("remove/{id}",[productController::class,"remove"]);





Route::get("/pod",[productController::class,"pod"]);//pod means Pay On Delivery
Route::get("/stripe/{total}",[productController::class,"stripe"]);
Route::Post("/stripe/{total}",[productController::class,"stripePost"])->name("stripe.post");


Route::get("order",[productController::class,"adminPanel"]);


Route::get("update/{id}",[productController::class,"update"]);
Route::get("print/{id}",[productController::class,"print_pdf"]);
Route::get("email/{id}",[productController::class,"send_email"]);

Route::post("sendMail/{id}",[productController::class, "sendMail"]);