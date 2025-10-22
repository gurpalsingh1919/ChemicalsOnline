<?php
use App\Models\User;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\Admin\ProductDocumentationController;

Route::get('/product-docs', [ProductDocumentationController::class, 'alphabetical']);
Route::get('/product-docs/{slug}', [ProductDocumentationController::class, 'show']);

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
     });*/
Route::middleware('auth:sanctum')->group(function () {
    // Get logged-in user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Get logged-in user's orders
    Route::get('/my-orders', [ApiController::class, 'index']);
    Route::get('/my-orders/{id}', [ApiController::class, 'orderDetail']);
    Route::post('/change-password', [ApiController::class, 'forgotPassword']);
});



// Route::get('/captcha', [CaptchaController::class, 'generate']);
// Route::post('/send-otp', [OtpController::class, 'sendOtp']);
// Route::post('/verify-otp', [OtpController::class, 'verifyOtp']);




// Route::get('/products/search', function () {
//     return Product::all();
// });
Route::get('/products/search', [ApiController::class, 'search'])->name('product_search');
Route::post('/contact', [ApiController::class, 'contactUs']);
Route::get('products', [ApiController::class, 'getAllProducts'])->name('product_requests');
//Route::get('/collections/{slug}', [ApiController::class, 'byCategory']);
Route::get('/collections/{slug?}/{subcategorySlug?}', [ApiController::class, 'byCategory']);
Route::get('/industry/{slug}', [ApiController::class, 'byIndustry']);
Route::get('/products/{slug}', [ApiController::class, 'show']);
Route::post('/orders', [ApiController::class, 'placeOrder']);

Route::post('/orders-test', function () {
    return response()->json(['ok' => true]);
});

