<?php

// use App\Models\Category;
// use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;

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

// Route::get('/', function () {
//     ddd();
// })->name('home');

Route::get('/', [PostController::class, 'index'])->name('home');
Route::redirect('/home', '/');

// Route::get('posts/{post:slug}', function (Post $post) {
//     return view('post', [
//         'post' => $post
//     ]);
// });
Route::get('posts/{post:slug}', [PostController::class, 'show']);

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);

// Route::get('categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'posts' => $category->posts->sortByDesc('created_at')->load('category', 'author'),
//         'categories' => Category::all()
//     ]);
// });
// Check the filter method of PostController
// We are using uri query there to find posts of a particular category. The route method (commented route above) also works. Query method is another way to do the same process.

// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'posts' => $author->posts->sortByDesc('created_at')->load('category', 'author')
//     ]);
// });
// This route functionality was also replaced by filter method in the Post controller

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('login', [SessionController::class, 'create'])->middleware('guest');
Route::post('login', [SessionController::class, 'store'])->middleware('guest');

Route::post('newsletter', NewsletterController::class);

// Admin
Route::post('admin/posts', [AdminPostController::class, 'store'])->middleware('admin');
Route::get('admin/posts/create', [AdminPostController::class, 'create'])->middleware('admin');
Route::get('admin/posts', [AdminPostController::class, 'index'])->middleware('admin');
Route::get('admin/posts/{post}/edit', [AdminPostController::class, 'edit'])->middleware('admin');
Route::patch('admin/posts/{post}', [AdminPostController::class, 'update'])->middleware('admin');
Route::delete('admin/posts/{post}', [AdminPostController::class, 'destroy'])->middleware('admin');
