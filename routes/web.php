<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostDashboardController;

Route::get('/', function () {
    return view('home', ['title' => 'Home']);
});
Route::get('/posts', function () {
    $posts = Post::latest()->filter(request(['search','category', 'author']))->paginate(6)->withQueryString();
    return view('posts', ['title' => 'Blog', 'posts' => $posts]);
});

// Route model binding {namamodel:slug} custom model binding untuk mencari berdasarkan slug
Route::get('/posts/{post:slug}', function (Post $post){
    return view('post', ['title' => 'Blog Details', 'post' => $post]);
});

Route::get('/about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
// route ini harus ditulis sebelum route model binding
Route::get('/dashboard', [PostDashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard', [PostDashboardController::class, 'store']);
Route::get('dashboard/create', [PostDashboardController::class, 'create']);
// ini adalah route model binding
Route::delete('/dashboard/{post:slug}', [PostDashboardController::class, 'destroy']);
Route::get('dashboard/{post:slug}', [PostDashboardController::class, 'show']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
