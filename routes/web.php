<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardControllers;
use App\Http\Middleware\TrackUserOnlineStatus;
use App\Http\Controllers\AdoptionFormController;
use App\Http\Controllers\ClientProfileController;
use App\Http\Controllers\ServerProfileController;
use App\Http\Controllers\PageController; // ETO NA RAGH

Route::get('/', function () {
    return view('welcome');
});

Route::post('/user/offline', function (Request $request) {
    // Ensure the user is authenticated
    if ($request->user_id) {
        $user = User::find($request->user_id);
        if ($user) {
            $user->is_online = 0;  // Set user as offline
            $user->save();
        }
    }
    return response()->json(['status' => 'offline']);
});

Route::middleware(['auth', 'CheckRole:Admin','TrackUserOnlineStatus'])->group(function () {
    Route::get('/admin/{any}', function () {
        return view('pages.admin');
    })->where('any', '.*')->name('admin.any');
    Route::get('/server/dashboard',[ServerController::class, 'dashboard'])->name('server.dashboard');
    Route::get('/server/profile', [ServerProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/server/profile', [ServerProfileController::class, 'update'])->name('profile.update');
    Route::delete('/server/profile', [ServerProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/api/dashboard/count', [DashboardControllers::class, 'getCounts']);
    //Users Management
    Route::get('/api/users/lists', [UserController::class, 'getUsersList']);
    Route::get('/api/users/check/role', [UserController::class, 'getCurrentUserRole']);
    Route::put('/api/users/role/change/{user_id}', [UserController::class, 'updateRole']);
    Route::put('/api/users/role/suspend/{user_id}', [UserController::class, 'suspendUser']);
    Route::delete('/api/users/delete/{user_id}', [UserController::class, 'deleteUser']);

    //Reports Management
    Route::get('/api/reports/lists', [ReportController::class, 'reportsList']);
});

Route::middleware(['auth', 'TrackUserOnlineStatus'])->group(function () {
    Route::get('/profile', [ClientProfileController::class, 'edit'])->name('client.profile.edit');
    Route::patch('/profile', [ClientProfileController::class, 'update'])->name('client.profile.update');
    Route::delete('/profile', [ClientProfileController::class, 'destroy'])->name('client.profile.destroy');

    //Post Modifiers
    Route::post('/api/posts/upload', [PostController::class, 'createPost']);
    Route::post('/api/like/{post_id}', [PostController::class, 'likePost']);
    Route::get('/api/like-count/{post_id}', [PostController::class, 'getLikesCount']);
    Route::put('/api/post/edit/{post_id}', [PostController::class, 'updatePost']);
    Route::delete('/api/posts/delete/{post_id}', [PostController::class, 'deletePost']);
    
    //Post Interactions
    Route::post('/api/comments/submit', [CommentsController::class, 'postComment']);
    Route::put('/api/comments/edit/{comment_id}', [CommentsController::class, 'updateComment']);
    Route::delete('/api/comments/delete/{comment_id}', [CommentsController::class, 'deleteComment']);
    Route::post('/api/reports/submit/', [ReportController::class, 'submitReport']);
    Route::post('/api/adoption/submit', [AdoptionFormController::class, 'submitAdoption']);
});
Route::get('/api/posts/list', [PostController::class, 'postList']);
Route::get('/api/comments/post/{post_id}', [CommentsController::class, 'getCommentsByPost']);

// page controller paayos nalang jahefglkag
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/announcements', [PageController::class, 'announcements'])->name('announcements');
Route::get('/events', [PageController::class, 'events'])->name('events');
Route::get('/shelters', [PageController::class, 'shelters'])->name('shelters'); 
Route::get('/browse', [PageController::class, 'browse'])->name('browse'); 
Route::get('/posts', [PageController::class, 'posts'])->name('posts'); 

Route::get('/pages/profile', [PageController::class, 'profile'])->name('profile'); 
Route::get('/pages/others-profile', [PageController::class, 'others_profile'])->name('others-profile'); 

Route::post('/suspend-user', [UserController::class, 'extendSuspension'])->name('suspend.user');

Route::get('/terms-of-service', [PageController::class, 'TermsOfService'])->name('terms-of-service');
Route::get('/privacy-policy', [PageController::class, 'PrivacyPolicy'])->name('privacy-policy');

Route::post('/set-theme', function (\Illuminate\Http\Request $request) {
    $theme = $request->input('theme', 'light'); // Default to 'light' if no theme is provided
    session(['theme' => $theme]); // Store theme in session
    return back(); // Redirect back to the previous page
})->name('set-theme');

 



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