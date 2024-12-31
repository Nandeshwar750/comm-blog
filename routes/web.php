<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HomeController,
    AboutController,
    ContactController,
    SearchController
};
use App\Livewire\Posts\Actions\{
    PostIndexComponent,
    PostShowComponent,
    PostCreateComponent,
    PostEditComponent
};

use Illuminate\Support\Facades\Artisan;


// Basic Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'index'])->name('about');
Route::get('/contact', [HomeController::class, 'index'])->name('contact');
// Route::get('/search', [HomeController::class, 'index'])->name('search');

Route::get('/search', function () {
    return view('search', [
        'query' => request('query')
    ]);
})->name('search');

// Authentication & Dashboard
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Blog Posts - Livewire Components
Route::prefix('posts')->group(function () {
    Route::get('/', PostIndexComponent::class)->name('posts.index');
    Route::get('/create', PostCreateComponent::class)
        ->middleware('auth')
        ->name('posts.create');
    Route::get('/{post}/edit', PostEditComponent::class)
        ->middleware('auth')
        ->name('posts.edit');
    Route::get('/{post}', PostShowComponent::class)
        ->name('posts.show');
});

require __DIR__ . '/auth.php';


// Utility routes
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    echo "Application cache cleared.<br>";
    Artisan::call('route:clear');
    echo "Route cache cleared.<br>";
    Artisan::call('config:clear');
    echo "Config cache cleared.<br>";
    Artisan::call('view:clear');
    echo "View cache cleared.<br>";
    Artisan::call('clear-compiled');
    echo "Compiled classes cleared.<br>";
    // Artisan::call('config:cache');
    // echo "Config cache rebuilt.<br>";

    return "All caches cleared!";
});