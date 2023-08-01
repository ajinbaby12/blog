<?php

// use App\Models\Category;
// use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'index'])->name('home');

// Route::get('posts/{post:slug}', function (Post $post) {
//     return view('post', [
//         'post' => $post
//     ]);
// });
Route::get('posts/{post:slug}', [PostController::class, 'show']);

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
