<?php

// use App\Models\Category;
// use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RssFeedController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminPostController;
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

Route::middleware('auth')->group(function () {

    Route::post('posts', [PostController::class, 'store']);
    Route::get('posts/create', [PostController::class, 'create']);
    Route::get('posts/{post}/edit', [PostController::class, 'edit']);
    Route::patch('posts/{post}', [PostController::class, 'update']);


});


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

Route::get('login', [SessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('login', [SessionController::class, 'store'])->middleware('guest')->name('login');

Route::post('newsletter', NewsletterController::class);

Route::get('feed', RssFeedController::class);

Route::get('profile/{author:username}', [UserController::class, 'show']);
// Route::get('profile/{author:username}/edit', [UserController::class, 'edit'])->middleware('can:owner');
Route::get('profile/{author:username}/edit', [UserController::class, 'edit'])->middleware('auth');
Route::patch('profile/{author}', [UserController::class, 'update'])->middleware('auth');

Route::post('profile/{author}/follow', [UserController::class, 'followAuthor'])->middleware('auth');
Route::delete('profile/{author}/unfollow', [UserController::class, 'unfollowAuthor'])->name('unfollow.author')->middleware('auth');

// Admin
Route::prefix('admin')->middleware('can:admin')->name('admin.')->group(function () {

    Route::resource('posts', AdminPostController::class)->except(['show', 'create', 'store']);

    // Route::post('posts', [AdminPostController::class, 'store']);
    // Route::get('posts/create', [AdminPostController::class, 'create']);
    // Route::get('posts', [AdminPostController::class, 'index']);
    // Route::get('posts/{post}/edit', [AdminPostController::class, 'edit']);
    // Route::patch('posts/{post}', [AdminPostController::class, 'update']);
    // Route::delete('posts/{post}', [AdminPostController::class, 'destroy']);
});
// can:admin applies the admin Gate as a middleware
