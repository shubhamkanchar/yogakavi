<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DietController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/yoga', [UserController::class, 'getYoga'])->name('form.yoga');
Route::post('/yoga-lead', [UserController::class, 'yogaLead'])->name('yoga.lead');

Route::get('/diet', [UserController::class, 'getDiet'])->name('form.diet');
Route::post('/diet-lead', [UserController::class, 'dietLead'])->name('diet.lead');

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{uuid}', [AdminUserController::class, 'userProfile'])->name('users.profile');

    Route::get('/diet/create/{uuid}', [DietController::class, 'create'])->name('diet.create');
    Route::post('/diet/store', [DietController::class, 'store'])->name('diet.store');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/sample1',function(){
    return view('sample1');
});
Route::get('/sample2',function(){
    return view('sample2');
});
Route::get('/sample3',function(){
    return view('sample3');
});