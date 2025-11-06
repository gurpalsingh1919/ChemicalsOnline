<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDocumentationController;


use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
//     return view('welcome');
// });


Route::middleware('guest')->post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('adminlogin.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    auth()->login($user); // 🔹 Auto-login after register

    return response()->json([
        'message' => 'Registration successful',
        'user' => $user,
    ]);
});


Route::middleware(['auth', 'super_admin'])->prefix('admin')->name('admin.')->group(function () {
        
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/all-users', [AdminController::class, 'allUsers'])->name('all_users');
    Route::resource('categories', CategoryController::class);
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');


    Route::resource('docs', ProductDocumentationController::class);


    // Start General-Settings
    
    Route::get('general-settings', [AdminController::class, 'generalSettings'])->name('general_settings');
    Route::post('update-settings', [AdminController::class, 'updateSettings'])->name('update_settings');

    Route::get('create-settings', [AdminController::class, 'createNewSettings'])->name('create_settings');
    Route::post('create-settings-post', [AdminController::class, 'createSettingsPost'])->name('create_settings_post');
    // Contact routes

    Route::get('/all-contact-requests', [AdminController::class, 'all_contactrequests'])->name('all_contactrequests');
    Route::get('contact-us/status/{contactUs_id}', [AdminController::class, 'updateContactUsStatus'])->name('contact_us_status');


    /**************** Product Routes **********************/
    //Route::get('/products', [ProductController::class, 'all_products'])->name('all_products');
    Route::get('/add-product', [ProductController::class, 'add_product'])->name('add_product');
    Route::post('/save-product', [ProductController::class, 'save_product'])->name('save_product');
    //Route::post('/import-product', [ProductController::class, 'import_products'])->name('import_products');
    //Route::get('/export-excel', [ProductController::class, 'downloadTemplate'])->name('download-template');


    Route::get('products/import', [ProductController::class, 'showImportForm'])->name('import_form');
    Route::post('products/import', [ProductController::class, 'import'])->name('import_save');


    Route::get('/products', [ProductController::class, 'all_products'])->name('all_products');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit_product'])->name('edit-product');
    Route::post('/product/update/{id}', [ProductController::class, 'update_product'])->name('update-product');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete_product'])->name('delete-product');
    Route::get('/search-products', [ProductController::class, 'productList'])->name('product-list');

});




