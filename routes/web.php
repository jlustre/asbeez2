<?php

use Illuminate\Support\Facades\Route;
// use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;

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
    return view('welcome');
});

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
    $users = DB::table('users')->get(); //Query Builder
    
    return view('dashboard', compact('users'));
})->name('dashboard');
