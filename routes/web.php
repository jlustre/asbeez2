<?php

use Illuminate\Support\Facades\Route;
// use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SliderController;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $sliders = DB::table('sliders')->latest()->get();
    return view('home', compact('brands', 'sliders'));
});

Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImage'])->name('store.image');

Route::get('/slider/all', [SliderController::class, 'AllSlider'])->name('all.slider');
Route::post('/slider/add', [SliderController::class, 'AddSlider'])->name('store.slider');
Route::get('/slider/edit/{id}', [SliderController::class, 'Edit']);
Route::get('/slider/softdelete/{id}', [SliderController::class, 'SoftDelete']);
Route::post('/slider/update/{id}', [SliderController::class, 'Update']);
Route::get('/slider/restore/{id}', [SliderController::class, 'Restore']);
Route::get('/slider/pdelete/{id}', [SliderController::class, 'ForceDelete']);

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'AddBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::get('/brand/softdelete/{id}', [BrandController::class, 'SoftDelete']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/restore/{id}', [BrandController::class, 'Restore']);
Route::get('/brand/pdelete/{id}', [BrandController::class, 'ForceDelete']);

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'SoftDelete']);
Route::post('/category/update/{id}', [CategoryController::class, 'Update']);
Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('/category/pdelete/{id}', [CategoryController::class, 'ForceDelete']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all(); //ELoquent ORM
    // $users = DB::table('users')->get(); //Query Builder
    
    return view('admin.index');
})->name('dashboard');

Route::get('/admin/logout', [BrandController::class, 'Logout'])->name('user.logout');
