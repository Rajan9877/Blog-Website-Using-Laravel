<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/adminindex', function () {
//     return view('admin.index');
// })->name('adminindex');
// Route::get('/author', function () {
//     return view('author');
// });
// Route::get('/', function () {
//     return view('index');
// })->name('index');
// Route::get('/search', function () {
//     return view('search');
// });
// Route::get('/single', function () {
//     return view('single');
// });
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');
Route::get('/add-category', function () {
    return view('admin.add-category');
})->name('addcategory');
// Route::get('/add-post', function () {
//     return view('admin.add-post');
// });
Route::get('/add-usr', function () {
    return view('admin.add-user');
})->name('add_usr');
// Route::get('/category', function () {
//     return view('admin.category');
// });
// Route::get('/post', function () {
//     return view('admin.post');
// });
Route::get('/update-category', function () {
    return view('admin.update-category');
});
// Route::get('/update-post', function () {
//     return view('admin.update-post');
// })->name('update_post');
// Route::get('/update-user', function () {
//     return view('admin.update-user');
// });
// Route::get('/users', function () {
//     return view('admin.users');
// });
Route::get('/cat', function () {
    return view('category');
});
Route::get('/forgot-password', function () {
    return view('forgot_password');
})->name('forgot-password');

Route::post('add_user',[AdminController::class,'add_user'])->name('add_user');
Route::post('login',[AdminController::class,'login'])->name('login');
Route::get('logout',[AdminController::class,'logout'])->name('logout');
Route::post('add_category',[AdminController::class,'add_category'])->name('add_category');
Route::get('add_post',[AdminController::class,'add_post'])->name('add_post');
Route::post('add_posts',[AdminController::class,'add_posts'])->name('add_posts');
Route::get('category',[AdminController::class,'category'])->name('category');
Route::get('delete/{post_id}',[AdminController::class,'delete'])->name('delete');
Route::get('posts',[AdminController::class,'posts'])->name('posts');
Route::get('users',[AdminController::class,'users'])->name('users');
Route::get('deleteuser/{user_id}',[AdminController::class,'deleteuser'])->name('deleteuser');
Route::get('updateuser/{user_id}',[AdminController::class,'updateuser'])->name('updateuser');
Route::post('updateusr',[AdminController::class,'updateusr'])->name('updateusr');
Route::get('updatepost/{post_id}',[AdminController::class,'updatepost'])->name('updatepost');
Route::post('updateposts',[AdminController::class,'updateposts'])->name('updateposts');
Route::get('deletecategory/{category_id}',[AdminController::class,'deletecategory'])->name('deletecategory');
Route::get('updatecategory/{category_id}',[AdminController::class,'updatecategory'])->name('updatecategory');
Route::post('updatecat',[AdminController::class,'updatecat'])->name('updatecat');
Route::get('/',[UserController::class,'index'])->name('home');
Route::get('/single/{post_id}',[UserController::class,'single'])->name('single');
Route::post('/search',[UserController::class,'search'])->name('search');
Route::get('/categories/{categories}',[UserController::class,'categories'])->name('categories');
Route::get('/author/{author}',[UserController::class,'author'])->name('author');
Route::get('/comment',[UserController::class,'comment'])->name('comment');
Route::get('/user_login',[UserController::class,'user_login'])->name('user_login');
Route::get('/user_signup',[UserController::class,'user_signup'])->name('user_signup');
Route::post('/user_signup_post',[UserController::class,'user_signup_post'])->name('user_signup_post');
Route::post('/user_login_post',[UserController::class,'user_login_post'])->name('user_login_post');
Route::get('/user_logout',[UserController::class,'user_logout'])->name('user_logout');
Route::post('/forgot_password',[UserController::class,'forgot_password'])->name('forgot_password');
Route::get('/reset-password', function (Illuminate\Http\Request $request) {
    $email = $request->query('email');
    $token = $request->query('token');  
    return view('reset_password', compact('email','token'));
})->name('reset-password');

Route::post('/reset_password',[UserController::class,'reset_password'])->name('reset_password');