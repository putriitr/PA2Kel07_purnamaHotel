<?php

use Illuminate\Support\Facades\Route;

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
    return view('layout.home');
});

Route::get('/facility', function () {
    return view('layout.facility');
});

Route::get('/gallery', function () {
    return view('layout.gallery');
});

Route::get('/event', function () {
    return view('layout.event');
});

Route::get('/room', function () {
    return view('layout.room');
});

Route::get('/contact', function () {
    return view('layout.contact');
});

Route::get('/book', function () {
    return view('layout.autentikasi');
});

<<<<<<< HEAD
Route::get('/admin', function () {
    return view('admin.home');
});

Route::prefix('admin')->namespace('App\Http\Controllers')->group(function () {
    // Route login
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::middleware(['Admin'])->group(function () {
        // Route dashboard
        Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
        // Route logout
        Route::get('logout', 'AdminController@logout');

        // Route resource for 'announcement category'
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

        // Route::get('saran', [DashboardController::class, 'saran'])->name('admin.saran');

        // Route::get('surat', [DashboardController::class, 'surat'])->name('admin.surat');

        // Route::get('surat/{id}', [DashboardController::class, 'viewSurat'])->name('viewSurat');

        // Route::post('surat/{id}', [DashboardController::class, 'suratapprove'])->name('aprovesurat');

    });
=======
Route::get('/form', function () {
    return view('layout.booking');
>>>>>>> origin/main
});
