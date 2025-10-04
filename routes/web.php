<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Backend\HomeController;
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
        Route::post('/edit-features/{id}', 'EditFeature')->name('edit.features'); //edit{feature} when click (js)
        Route::post('/edit-review/{id}', 'EditReviewe')->name('edit.review'); //edit{review} when click (js)
        Route::post('/edit-answers/{id}', 'EditAnswers')->name('edit.answers'); //edit{answers} when click (js)


    });

       Route::controller(HomeController::class)->group(function () {
        Route::get('feature', 'allFeature')->name('all.feature');
        Route::get('/feature/add', 'addFeature')->name('add.feature');
        Route::post('/feature/store', 'storeFeature')->name('store.feature');
        Route::get('/feature/edit/{id}', 'editFeature')->name('edit.feature');
        Route::post('/feature/update', 'updateFeature')->name('update.feature');
        Route::get('/feature/delete/{id}', 'deleteFeature')->name('delete.feature');


        /* **************************************clarifies  *************************** */
    Route::get('/clarifies', 'clarifies')->name('get.clarifies');
    Route::post('/clarifies/update', 'updateClarifies')->name('update.clarifi');
        /* **************************************usability  *************************** */

    Route::get('/usability', 'getUsability')->name('get.usability');
    Route::post('/update/usability', 'updateUsability')->name('update.usability');


            /* **************************************connect  *************************** */

    Route::get('/connect', 'getConnect')->name('all.connect');
    Route::get('/add/connect', 'addConnect')->name('add.connect');
    Route::post('/store/connect', 'storeConnect')->name('store.connect');
    Route::post('/update-connect/{id}', 'updateConnect')->name('update.connect'); //js

            /* ************************************** faqs  *************************** */


    Route::get('/add/faqs',  'addFaqs')->name('add.faqs');
    Route::post('/store/faqs',  'storeFaqs')->name('store.faqs');
    Route::get('/all/faqs', 'allFaqs')->name('all.faqs');
    Route::get('/edit/faqs/{id}', 'editFaqs')->name('edit.faqs');
    Route::get('/delete/faqs/{id}', 'deleteFaqs')->name('delete.faqs');
    Route::post('/update/faqs', 'updateFaqs')->name('update.faqs');
 
    });










   

    Route::get('/dadadxcv', [ProfileController::class, 'destroy'])->name('add.faqs');
    Route::get('/dadadv', [ProfileController::class, 'destroy'])->name('all.faqs');
  
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




