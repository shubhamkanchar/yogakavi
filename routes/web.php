<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DietController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::post('/contact-us', [ContactController::class, 'store'])->name('contact.store');

Route::get('/', [LandingController::class, 'index'])->name('welcome');

Route::get('/yoga', [UserController::class, 'getYoga'])->name('form.yoga');
Route::post('/yoga-lead', [UserController::class, 'yogaLead'])->name('yoga.lead');
Route::post('/razorpay/webhook', [WebhookController::class, 'handle']);
Route::get('/diet', [UserController::class, 'getDiet'])->name('form.diet');
Route::post('/diet-lead', [UserController::class, 'dietLead'])->name('diet.lead');

Route::name('admin.')->middleware('auth')->group(function () {
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{uuid}', [AdminUserController::class, 'userProfile'])->name('users.profile');

    Route::get('/diet/create/{uuid}', [DietController::class, 'create'])->name('diet.create');
    Route::post('/diet/store', [DietController::class, 'store'])->name('diet.store');

    Route::get('/broadcast/create', [\App\Http\Controllers\Admin\BroadcastController::class, 'create'])->name('broadcast.create');
    Route::post('/broadcast/preview', [\App\Http\Controllers\Admin\BroadcastController::class, 'preview'])->name('broadcast.preview');
    Route::post('/broadcast/send-email', [\App\Http\Controllers\Admin\BroadcastController::class, 'sendEmails'])->name('broadcast.send_email');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/diet-plan/{uuid}/pdf', [DietController::class, 'downloadPdf'])->name('diet.plan.pdf');
    Route::get('/diet-plan/{uuid}', [DietController::class, 'viewDietPlan'])->name('diet.plan.view');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/checkout/{plan:uuid}', [SubscriptionController::class, 'checkout'])->name('subscription.checkout');
    Route::post('/create-order/{plan:uuid}',[SubscriptionController::class, 'createOrder'])->name('subscription.createOrder');
    Route::post('/verify-payment/{plan:uuid}',[SubscriptionController::class, 'verifyPayment'])->name('subscription.verifyPayment');
    Route::post('/subscription/{subscription:uuid}/renew',[SubscriptionController::class, 'renew'])->name('subscription.renew');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/sample1', function () {
    return view('sample1');
});
Route::get('/sample2', function () {
    return view('sample2');
});
Route::get('/sample3', function () {
    return view('sample3');
});
