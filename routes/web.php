<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Users\AdminUserController;
use App\Http\Controllers\Admin\Access\RoleController;
use App\Http\Controllers\Admin\Access\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Super Admin dashboard & management
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Manage Admin Users
    Route::resource('admins', AdminUserController::class)->except(['show']);
    Route::get('admins/{admin}/permissions', [AdminUserController::class, 'editPermissions'])->name('admins.permissions.edit');
    Route::put('admins/{admin}/permissions', [AdminUserController::class, 'updatePermissions'])->name('admins.permissions.update');

    // Roles & Permissions
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/{role}/permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');
    Route::put('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');

    Route::resource('permissions', PermissionController::class)->except(['show']);
});

// Normal Admin dashboard (limited panel)
Route::prefix('admin/panel')->name('admin.panel.')->middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/', function () {
        return view('admin.panel.dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin_auth.php';
