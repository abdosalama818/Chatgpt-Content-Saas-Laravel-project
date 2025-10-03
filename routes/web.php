<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\ProfileController;
use App\Models\Review;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view("home.index");
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
    /* ********************************** Review Controller ************************************* */
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/all/review', 'AllReview')->name('all.review');
        Route::get('/add/review', 'AddReview')->name('add.review');
        Route::post('/store/review', 'StoreReview')->name('store.review');
        Route::get('/edit/review/{id}', 'EditReview')->name('edit.review');
        Route::patch('/update/review', 'UpdateReview')->name('update.review');
        Route::get('/delete/review/{id}', 'DeleteReview')->name('delete.review');
    });

    /* ********************************** Slider Controller ************************************* */

    Route::controller(SliderController::class)->group(function () {
        Route::get('slider', 'AllSlider')->name('get.slider');
        Route::patch('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::post('/edit-slider/{id}', 'EditSlider')->name('Edit.slider'); //edit when click (js)

    });








   
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

    Route::get('/ about.us about.us', [ProfileController::class, 'about.us'])->name('about.us');
    Route::get('/ about.us contact.us', [ProfileController::class, 'contact.us'])->name('contact.us');
    Route::get('/ about.us about.sus', [ProfileController::class, 'about.us'])->name('our.team');
    Route::get('/ about.us abgout.sus', [ProfileController::class, 'about.use'])->name('blog.page');
    
   
  
  
});

require __DIR__.'/auth.php';




