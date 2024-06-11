<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;

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

Route::get('/', [FrontController::class, 'dashboard'])->name('home');

Route::get('/gallery', [FrontController::class, 'gallery'])->name('gallery');

Route::get('/facility', [FrontController::class, 'facility'])->name('facility');

Route::get('/announcement', [FrontController::class, 'announcement'])->name('announcement');

Route::get('/room', [FrontController::class, 'room'])->name('room');

Route::get('/room/{id}', [FrontController::class, 'showroom'])->name('room.show');

Route::get('/staff', [FrontController::class, 'staff'])->name('staff');

Route::get('/contact', function () {
    return view('layout.contact');
});


Route::get('/admin', function () {
    return view('admin.home');
});

Route::prefix('admin')->namespace('App\Http\Controllers')->group(function () {
    Route::match (['get', 'post'], 'login', 'AdminController@login');

    Route::middleware(['Admin'])->group(function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');

        Route::get('/admin/export-excel', [AdminController::class, 'exportExcel'])->name('admin.exportExcel');

        Route::get('logout', 'AdminController@logout');

        Route::get('announcementcategory', 'AnnouncementCategoryController@index')->name('announcementcategory.index');
        Route::get('announcementcategory/create', 'AnnouncementCategoryController@create')->name('announcementcategory.create');
        Route::post('announcementcategory/create', 'AnnouncementCategoryController@store')->name('announcementcategory.store');
        Route::get('announcementcategory/{id}/edit', 'AnnouncementCategoryController@edit')->name('announcementcategory.edit');
        Route::put('announcementcategory/{id}', 'AnnouncementCategoryController@update')->name('announcementcategory.update');
        Route::delete('announcementcategory/{id}', 'AnnouncementCategoryController@destroy')->name('announcementcategory.destroy');

        Route::get('announcement', 'AnnouncementController@index')->name('announcement.index');
        Route::get('announcement/create', 'AnnouncementController@create')->name('announcement.create');
        Route::post('announcement/create', 'AnnouncementController@store')->name('announcement.store');
        Route::get('announcement/{id}/edit', 'AnnouncementController@edit')->name('announcement.edit');
        Route::put('announcement/{id}', 'AnnouncementController@update')->name('announcement.update');
        Route::delete('announcement/{id}', 'AnnouncementController@destroy')->name('announcement.destroy');

        Route::get('roomcategory', 'RoomCategoryController@index')->name('roomcategory.index');
        Route::get('roomcategory/create', 'RoomCategoryController@create')->name('roomcategory.create');
        Route::post('roomcategory/create', 'RoomCategoryController@store')->name('roomcategory.store');
        Route::get('roomcategory/{id}/edit', 'RoomCategoryController@edit')->name('roomcategory.edit');
        Route::put('roomcategory/{id}', 'RoomCategoryController@update')->name('roomcategory.update');
        Route::delete('roomcategory/{id}', 'RoomCategoryController@destroy')->name('roomcategory.destroy');

        Route::get('facility', 'FacilityController@index')->name('facility.index');
        Route::get('facility/create', 'FacilityController@create')->name('facility.create');
        Route::post('facility/create', 'FacilityController@store')->name('facility.store');
        Route::get('facility/{id}/edit', 'FacilityController@edit')->name('facility.edit');
        Route::put('facility/{id}', 'FacilityController@update')->name('facility.update');
        Route::delete('facility/{id}', 'FacilityController@destroy')->name('facility.destroy');

        Route::get('gallerycategory', 'GalleryCategoryController@index')->name('gallerycategory.index');
        Route::get('gallerycategory/create', 'GalleryCategoryController@create')->name('gallerycategory.create');
        Route::post('gallerycategory/create', 'GalleryCategoryController@store')->name('gallerycategory.store');
        Route::get('gallerycategory/{id}/edit', 'GalleryCategoryController@edit')->name('gallerycategory.edit');
        Route::put('gallerycategory/{id}', 'GalleryCategoryController@update')->name('gallerycategory.update');
        Route::delete('gallerycategory/{id}', 'GalleryCategoryController@destroy')->name('gallerycategory.destroy');

        Route::get('gallery', 'GalleryController@index')->name('gallery.index');
        Route::get('gallery/create', 'GalleryController@create')->name('gallery.create');
        Route::post('gallery/create', 'GalleryController@store')->name('gallery.store');
        Route::get('gallery/{id}/edit', 'GalleryController@edit')->name('gallery.edit');
        Route::put('gallery/{id}', 'GalleryController@update')->name('gallery.update');
        Route::delete('gallery/{id}', 'GalleryController@destroy')->name('gallery.destroy');

        Route::get('staff', 'StaffController@index')->name('staff.index');
        Route::get('staff/create', 'StaffController@create')->name('staff.create');
        Route::post('staff/create', 'StaffController@store')->name('staff.store');
        Route::get('staff/{id}/edit', 'StaffController@edit')->name('staff.edit');
        Route::put('staff/{id}', 'StaffController@update')->name('staff.update');
        Route::delete('staff/{id}', 'StaffController@destroy')->name('staff.destroy');

        Route::get('room', 'RoomController@index')->name('room.index');
        Route::get('room/create', 'RoomController@create')->name('room.create');
        Route::post('room/create', 'RoomController@store')->name('room.store');
        Route::get('room/{id}/edit', 'RoomController@edit')->name('room.edit');
        Route::put('room/{id}', 'RoomController@update')->name('room.update');
        Route::delete('room/{id}', 'RoomController@destroy')->name('room.destroy');

        Route::get('message', 'ContactController@showMessage')->name('message');

        Route::post('/messages/{id}/reply', [ContactController::class, 'reply'])->name('messages.reply');

        Route::get('/admin/payments', [AdminController::class, 'showPayments'])->name('admin.payments');

        Route::patch('/payments/{id}/approve', 'PaymentController@approve')->name('payments.approve');

        Route::patch('/payments/{id}/reject', 'PaymentController@reject')->name('payments.reject');

        Route::middleware(['auth:admin'])->group(function () {
            Route::get('/admin/notifications', [AdminController::class, 'showNotifications'])->name('showNotifications');
            Route::get('/admin/notifications/read/{id}', [AdminController::class, 'markNotificationAsRead'])->name('markNotificationAsRead');
        });

        Route::get('mark/{id}', 'AdminController@read')->name('mark');
        Route::get('markasread/{id}', 'AdminController@markasread')->name('markasread');

    });
});


Route::prefix('customer')->namespace('App\Http\Controllers')->group(function () {
    Route::match (['get', 'post'], 'login', [CustomerController::class, 'login'])->name('login');

    Route::match (['get', 'post'], 'register', [CustomerController::class, 'register'])->name('customer.register');

    Route::middleware(['Customer'])->group(function () {
        Route::get('logout', [CustomerController::class, 'logout'])->name('customer.logout');

        Route::get('/customer/home', [CustomerController::class, 'home'])->name('customer.home');

        Route::get('book/{roomId}', 'CustomerController@booking')->name('book.room');

        Route::resource('contacts', ContactController::class)->except(['edit', 'update', 'destroy', 'show']);

        Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');

        Route::get('/payment/{bookingId}', [PaymentController::class, 'showPaymentForm'])->name('payment.form');

        Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

        Route::post('/room/{roomId}/review', [RoomController::class, 'review'])
            ->name('room.review.create');

        Route::get('/history', [FrontController::class, 'showBookings'])->name('user.bookings');

        Route::get('markasread/{id}', 'CustomerController@markasread')->name('markasread');

        Route::delete('/booking/{bookingId}/cancel', 'BookingController@cancel')->name('booking.cancel');

    });
});




// Route::get('saran', [FronController::class, 'saran'])->name('saran');

// Route::post('saran', [FronController::class, 'saranStore'])->name('saranStore');

// Route::delete('saran/{id}', [FronController::class, 'saranDelete'])->name('saranDelete');

// Route::get('saran/{id}', [FronController::class, 'saranEdite'])->name('saranEdite');

// Route::post('saran/{id}', [FronController::class, 'saranUpdate'])->name('saranUpdate');

// Route::get('surat/all', [FronController::class, 'surat'])->name('surat.all');

// Route::get('cetakSurat/{id}', [FronController::class, 'cetak'])->name('cetak');

// Route::post('surat/simpan', [FronController::class, 'suratStore'])->name('suratStore');

