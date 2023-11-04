<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PayFastController;
use App\Http\Controllers\SignatureController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     // return Inertia::render('Dashboard');
//     return Inertia::render('Tailwind');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
Route::get('/return',function(){
    

    return Inertia::render('ReturnPage');

});

Route::post('/notify',[PayFastController::class,'handleNotification']);
// Route::post('/checkout2',[SignatureController::class,'generateSignature']);
// Route::get('/checkout2',[SignatureController::class,'generateSignature']);

Route::get('/',[FrontPageController::class,'index']);
Route::get('/addProductToCart',[ProductsController::class,'addProductToCart'])->name('addProductToCart');
Route::post('/checkout',[SignatureController::class,'generateSignature'])->name('generateSignature');
Route::post('/checkout2',[SignatureController::class,'generateSignature']);

Route::middleware('auth')->group(function () {
    Route::get('/products',[ProductsController::class,'index'])->name('products.edit');
    Route::get('/products_add',[ProductsController::class,'showAddProductsPage'])->name('productsAddPage');
    Route::get('/Edit Products',[ProductsController::class,'edit'])->name('editProduct');
    Route::post('/product update',[ProductsController::class,'update'])->name('productUpdate');
    Route::post('/product delete',[ProductsController::class,'destroy'])->name('productDelete');
    Route::post('/products',[ProductsController::class,'addProduct'])->name('productAdd');


    //addProductToCart
    //products
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
