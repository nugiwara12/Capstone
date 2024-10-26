<?php

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ContactUsFormController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationMailer;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\PaymentController;







/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ----------------------------- Start Backlog-----------------------//
// Route::group(['middleware' => 'prevent-back-history'],function(){


Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', [AuthController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Route for user index
Route::get('/user', [AuthController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('/user');
//->middleware('redirect.authenticated');

require __DIR__.'/auth.php';

// ----------------------------- LOGIN AND RESITER -----------------------//
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});
// ----------------------------- SHOP -----------------------//
Route::controller(ShopController::class)->group(function () {
    Route::get('shop', 'shop')->name('shop');
    Route::get('about_us', 'aboutUs')->name('about_us');
    Route::get( 'product-details/{id}', 'show')->name('product-details');
 });

// ----------------------------- Contact Us-----------------------//
Route::get('/contact', [ContactUsFormController::class, 'createForm'])->name('contact');
Route::post('/contact', [ContactUsFormController::class, 'ContactUsForm'])->name('contact.store');
Route::get('/index', [ContactUsFormController::class, 'index'])->name('contacts.index');
Route::get('/components/sidebar', [ContactUsFormController::class, 'message'])->name('components.sidebar');
Route::get('/contacts/{id}', [ContactUsFormController::class, 'show'])->name('contact.show');
Route::delete('/contacts/{id}', [ContactUsFormController::class, 'destroy'])->name('contact.destroy');

// ----------------------------- ORDER-----------------------//
Route::get('/order', [OrderController::class, 'index'])->name('order.index');
Route::post('orders/{id}/delivered', [OrderController::class, 'delivered'])->name('order.delivered');
Route::post('orders/{id}/shipped', [OrderController::class, 'shipped'])->name('order.shipped');
Route::post('orders/{id}/packed', [OrderController::class, 'packed'])->name('order.packed');
Route::post('orders/{id}/preparing', [OrderController::class, 'preparing'])->name('order.preparing');
Route::post('/orders/store', [OrderController::class, 'store'])->name('order.store');
Route::delete('orders/{id}', [OrderController::class, 'delete'])->name('order.delete');


// ----------------------------- Category -----------------------//
Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('', 'index')->name('category');
    Route::middleware(['auth'])->group(function () {
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    
        Route::post('store', 'store')->name('category.store');
    Route::get('show/{id}', 'show')->name('category.show');
    Route::get('{id}/edit', 'edit')->name('category.edit');
    Route::put('{id}', 'update')->name('category.update'); // Adjusted to match the route
    Route::delete('destroy/{id}', 'destroy')->name('category.destroy');
});
});


// ----------------------------- PRODUCT -----------------------//
Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::middleware(['auth','verified'])->group(function () {
        Route::get('', 'index')->name('products');
        Route::get('create', 'create')->name('products.create');
        Route::get('create', 'create')->name('products.create');
        Route::post('store', 'store')->name('products.store');
        Route::get('show/{id}', 'show')->name('products.show');
        Route::get('edit/{id}', 'edit')->name('products.edit');
        Route::put('edit/{id}', 'update')->name('products.update');
        Route::delete('destroy/{id}', 'destroy')->name('products.destroy');
        Route::post('restore/{id}', 'restore')->name('products.restore'); // Add restore route here
        Route::post('add-to-cart', 'addToCart')->name('add.to.cart');
        Route::get('products/sold/index', [ProductController::class, 'listSoldProducts'])->name('products.sold.index');
    });
});
Route::post('/save-image', [ProductController::class, 'storingcustom'])->name('image.save');

Route::get('/user.index', [ProductController::class, 'allProducts'])->name('user.index');
Route::get('/best-sellers', [ProductController::class, 'bestSellers'])->name('best-sellers');
Route::get('/featured', [ProductController::class, 'featured'])->name('featured');
Route::get('/shops', [ProductController::class, 'shops'])->name('shops');

// USERMANAGEMENT ROUTES
Route::controller(ManagementUserController::class)->prefix('usermanagement')->group(function () {
    Route::get('/', 'index')->name('usermanagement'); 
    Route::get('create', 'create')->name('usermanagement.create');  
    Route::post('/', 'store')->name('usermanagement.store');   
    Route::get('{id}', 'show')->name('usermanagement.show');   
    Route::get('{id}/edit', 'edit')->name('usermanagement.edit');   
    Route::put('{id}', 'update')->name('usermanagement.update');  
    Route::delete('{id}', 'destroy')->name('usermanagement.destroy');
});

// ----------------------------- ACTIVITY-LOGS -----------------------//
Route::get('activity/log', [ManagementUserController::class, 'activity'])->name('activity/log');


// ----------------------------- OTP -----------------------//
Route::post('reset_password', [AuthController::class,'resetPassword']);
Route::get('forgot-password', function () {
    if(Session::has('current_user')){
        return redirect('dashboard');
    }else{
        return view('forgot-password');
    }
})->middleware('guest')->name('password.request');

Route::get('re-new-password', function (){

    return view('new-password')->with('failed','Invalid OTP code');
});
Route::post('/new-password', [AuthController::class,'findUserToChangePass']);
route::get('test-mail',function(){
    // Inside your function/method
    Session::put('reset_otp_code', random_int(000000,999999));
    Mail::to('gawanggamat1111@gmail.com')->send(new SendVerificationMailer());
});
Route::get('/new-password', [AuthController::class, 'newPassword'])->name('new-password');


// Subsription
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe.store');
// ----------------------------- Sales Report -----------------------//

Route::get('/sales-report', [SalesReportController::class, 'generateSalesReport'])->name('sales.report');

Route::controller(ShopController::class)->group(function () {
    Route::get('my_account', 'my_account')
        ->middleware(['auth', 'verified']) // Add middleware here
        ->name('my_account');
    Route::get( 'thankyou', 'thankYou')->name('thank-you');
    Route::get( 'customize/{id}', 'customize')->name('customize');
});

Route::get('/', function () {
    $featured = Product::where('featured', true)->get();
    $best_seller = Product::where('best_seller', true)->get();
    $category=Category::all();
    return view('welcome', compact('featured', 'best_seller', 'category'));
})->name('/');

Route::controller(ShopController::class)->group(function () {
    Route::get('my_account', 'my_account')
        ->middleware(['auth', 'verified']) // Add middleware here
        ->name('my_account');
    Route::get( 'thankyou', 'thankYou')->name('thank-you');
    Route::get( 'customize/{id}', 'customize')->name('customize');
});

// ----------------------------- CART -----------------------//
Route::controller(CartController::class)->group(function () {
    Route::get( 'cart', 'cart')->name('cart');
    Route::post('cart/{id}', 'addToCart')->name('addToCart');
    Route::get( 'checkout', 'checkout')->name('checkout');
    Route::delete('destroy/{id}', 'destroy')->name('remove_product');
});

Route::controller(StripePaymentController::class)->group(function(){
    Route::post('stripe', 'stripePost')->name('stripe.post');
});
Route::get('thankyou', [SubscriptionController::class, 'showThankYou'])->name('emails.subscription_confirmation');
Route::get('thankyou', [ContactUsFormController::class, 'showThankYou'])->name('emails.contact_us');
Route::get('/filtering', [CategoryController::class, 'filtering'])->name('filtering');


Route::post('/save-customization', [ProductController::class, 'saveCustomization'])->name('save.customization');
Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thankyou');

Route::post('/save-image', [ProductController::class, 'saveImage'])->name('save.image');
Route::get('cart/count', [CartController::class, 'cartCount'])->name('cart.count');

// ----------------------------- End Of Route Back Log -----------------------//
// });