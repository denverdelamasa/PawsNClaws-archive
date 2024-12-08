<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ServerProfileController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ClientProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController; // ETO NA RAGH

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'CheckRole:Admin'])->group(function () {
    Route::get('/server/dashboard',[ServerController::class, 'dashboard'])->name('server.dashboard');
    Route::get('/server/profile', [ServerProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/server/profile', [ServerProfileController::class, 'update'])->name('profile.update');
    Route::delete('/server/profile', [ServerProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ClientProfileController::class, 'edit'])->name('client.profile.edit');
    Route::patch('/profile', [ClientProfileController::class, 'update'])->name('client.profile.update');
    Route::delete('/profile', [ClientProfileController::class, 'destroy'])->name('client.profile.destroy');
    Route::post('/api/posts', [PostController::class, 'store']);
});


// page controller paayos nalang jahefglkag
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/announcements', [PageController::class, 'announcements'])->name('announcements');
Route::get('/events', [PageController::class, 'events'])->name('events');
Route::get('/shelters', [PageController::class, 'shelters'])->name('shelters'); 
Route::get('/browse', [PageController::class, 'browse'])->name('browse'); 
Route::get('/posts', [PageController::class, 'posts'])->name('posts'); 
Route::get('/pages/profile', [PageController::class, 'profile'])->name('profile'); 
 



Route::get('/api/partial/containers/browse/{content}', function ($content) {
    // Ensure only valid contents are allowed
    $validContents = [
        'browseAll',
        'browsePosts',
        'browseAnnouncements',
        'browseEvents',
        'browseShelters',
        'browseAccounts'
    ];

    if (in_array($content, $validContents)) {
        return response()->view("partials.containers.browse.$content");  // Dynamically load the Blade partial
    } else {
        return response("Content not found", 404);
    }
});
















require __DIR__.'/auth.php';