<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class,'login'])->name('login');
Route::post('authLogin', [AdminController::class,'authLogin'])->name('authLogin');

Route::middleware("auth")->group(function () {
    Route::get('admins/index', [AdminController::class,'index'])->name('admins.index');

    Route::get('users/search', 'UserController@search')->name('users.search');
    Route::resource('users',UserController::class);

    Route::get('staffs/search', 'StaffController@search')->name('staffs.search');
    Route::get('staffs/export','StaffController@export')->name('staffs.export');
    Route::post('staffs/import','StaffController@import')->name('staffs.import');
    Route::resource('staffs',StaffController::class);

    Route::get('timeKeepings/search', 'TimekeepingController@search')->name('timeKeepings.search');
    Route::resource('timeKeepings',TimekeepingController::class);

    Route::get('positions/search', 'PositionController@search')->name('positions.search');
    Route::resource('positions',PositionController::class);

    Route::get('departments/search', 'DepartmentController@search')->name('departments.search');
    Route::resource('departments',DepartmentController::class);

    Route::get('salaryDetails/search', 'SalaryDetailController@search')->name('salaryDetails.search');
    Route::resource('salaryDetails',SalaryDetailController::class);
});








