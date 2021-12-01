<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get("/",[HomeController::class,"home"])->name('homepage');
Route::get("/courses",[HomeController::class,"courses"])->name('courses');
Route::get("/apply",[HomeController::class,"apply"])->name('apply');
Route::get("/response",[HomeController::class,"response"])->name('response');


Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::post('/image_upload', [AdminController::class,"upload"])->name('upload');
    Route::resource('course', CourseController::class);
    Route::get('/',[AdminController::class,'index'] )->name('admin.dashboard');
    Route::get('/students',[AdminController::class,'students'])->name('students');
    Route::get('/add-student', function () {
        return view('admin.add_student');
    })->name('add.student.view');
    Route::get('/dues',[AdminController::class,'dues_payments'])->name('dues.payments');
    Route::get('/paid',[AdminController::class,'paid_payments'])->name('paid.payments');
    Route::post('/add-student',[AdminController::class,'addStudent'])->name('add.student');
    Route::post('/payment/pay', [AdminController::class,'pay_dues'])->name('set.payment.paid');
    Route::post('/payment/unpaid', [AdminController::class,'unpaid'])->name('set.payment.unpaid');
    Route::post('/send-sms',[AdminController::class,'sendSms'])->name('send.sms');
    Route::post('update-dues-amount',[AdminController::class,'updateDuesAmount'])->name('update.dues.amount');
    Route::get('/message-all-students',[AdminController::class,'messageAll'])->name('message.all.students');
    // Route::get('/sms-check', function () {
    //     echo  send('9113751193','hello');
    // });
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
