<?php


use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\Role\RolesController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\UserController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    /**
     * Profile ROute
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'avatarUpdate'])->name('profile.image');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Role Route
     */
    Route::resource('role', RolesController::class, ['except' => ['update']]);
    Route::post('/role/update/{role}', [RolesController::class, 'update'])->name('role.update');

    /**
     * User Route
     */
    Route::resource('user', UserController::class, ['except' => ['update']]);
    Route::post('/user/update/{user}', [UserController::class, 'update'])->name('user.update');
    Route::post('/user/image/{user}', [UserController::class, 'avatarUpdate'])->name('user.image.update');
    Route::delete('/user/image/{user}', [UserController::class, 'avatarDelete'])->name('user.image.destroy');

    /**
     * Options Route
     */
    Route::resource('options', OptionController::class, ['except' => ['update']]);
    Route::post('/options/update/{option:option_key}', [OptionController::class, 'update'])->name('options.update');
    Route::patch('/options/update', [OptionController::class, 'bulkUpdate'])->name('options.bulk.update');

    /**
     * Product Route
     */
    Route::resource('product', ProductController::class, ['except' => ['update']]);
    Route::post('/product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/product/image/{product}', [ProductController::class, 'imageUpdate'])->name('product.image.update');
    Route::delete('/product/image/{product}', [ProductController::class, 'imageDelete'])->name('product.image.destroy');


    /**
     * Category Route
     */
    Route::resource('category', CategoryController::class, ['except' => ['update', 'create']]);
    Route::post('/category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/image/{category}', [CategoryController::class, 'imageUpdate'])->name('category.image.update');
    Route::delete('/category/image/{category}', [CategoryController::class, 'imageDelete'])->name('category.image.destroy');
    Route::get('admin/category/create', [CategoryController::class, 'create'])->name('admin.category.create');


    /**
     * Image Route
     */
    Route::resource('image', ImageController::class, ['except' => ['update']]);

    Route::resource('address', AddressController::class, ['except' => ['update', 'index', 'edit']]);
    Route::post('/address/update/{address}', [AddressController::class, 'update'])->name('address.update');

    Route::post('mark-read', [NotificationController::class, 'markNotification'])
    ->name('notification.mark.read');
});
