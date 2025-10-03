<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    
Route::post('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('verify', [AdminController::class, 'showVerification'])->name('custom.verificationform');
Route::post('email/verify', [AdminController::class, 'customVerification'])->name('custom.verification');

Route::middleware('auth')->group(function () {
    Route::get('admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/store/profile', [AdminController::class, 'storeProfile'])->name('profile.store');
    Route::post('/passworf/update', [AdminController::class, 'updatePassword'])->name('admin.password.update');











    Route::get('/xxax', [ProfileController::class, 'destroy'])->name('all.review');
    Route::get('/xxx', [ProfileController::class, 'destroy'])->name('add.review');
    Route::get('/slider', [ProfileController::class, 'destroy'])->name('get.slider');
    Route::get('/feature', [ProfileController::class, 'destroy'])->name('all.feature');
    Route::get('/featureadd', [ProfileController::class, 'destroy'])->name('add.feature');
    Route::get('/clarifies', [ProfileController::class, 'destroy'])->name('get.clarifies');
    Route::get('/usability', [ProfileController::class, 'destroy'])->name('get.usability');
    Route::get('/dv', [ProfileController::class, 'destroy'])->name('all.connect');
    Route::get('/dadadxcv', [ProfileController::class, 'destroy'])->name('add.faqs');
    Route::get('/dadadv', [ProfileController::class, 'destroy'])->name('all.faqs');
     Route::get('/connect', [ProfileController::class, 'destroy'])->name('add.connect');
    Route::get('/connfect', [ProfileController::class, 'destroy'])->name('all.connect');
    Route::get('/connitemsfect', [ProfileController::class, 'destroy'])->name('all.items');
    Route::get('/team', [ProfileController::class, 'destroy'])->name('all.team');
    Route::get('/tadeam', [ProfileController::class, 'destroy'])->name('add.team');
    Route::get('/aboutus', [ProfileController::class, 'destroy'])->name('get.aboutus');
    Route::get('/aboutcaus', [ProfileController::class, 'destroy'])->name('all.blog.category');
    Route::get('/abouttcaus', [ProfileController::class, 'destroy'])->name('all.blog.post');
    Route::get('/aboutdtcaus', [ProfileController::class, 'destroy'])->name('add.blog.post');
    Route::get('/avboutdtcaus', [ProfileController::class, 'destroy'])->name('contact.all.message');
    
    
  
  
});

require __DIR__.'/auth.php';
