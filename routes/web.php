<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FollowController;

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

Route::get('/login', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::get('/profile/{user_id}', function () {
    return view('profile');
});

Route::get('/news', function () {
    return view('news');
});


Route::get('users', [UserController::class, 'index']);
Route::get('login/register/{username}/{password}', [UserController::class, 'register_user']);
Route::get('login/{username}/{password}', [UserController::class, 'login_user']);
Route::get('logout', [UserController::class, 'logout']);
Route::get('home/searchFriend/{friend}', [UserController::class, 'searchFriend']);
Route::get('profile/getInfo/{user_id}', [UserController::class, 'getUserInfo']);
Route::post('profile/saveImp', [UserController::class, 'saveImp']);

Route::get('home/getPosts/{id_user}', [PostController::class, 'getPosts']);
Route::get('profile/getPosts/{id_user}', [PostController::class, 'getPosts']);
Route::post('home/newPost', [PostController::class, 'newPost']);
Route::post('home/sharePost', [PostController::class, 'sharePost']);
Route::post('news/shareNews', [PostController::class, 'newPost']);
Route::get('home/deletePost/{id_post}', [PostController::class, 'deletePost']);
Route::get('profile/deletePost/{id_post}', [PostController::class, 'deletePost']);
Route::get('profile/like/{id_post}', [PostController::class, 'putLike']);
Route::get('home/like/{id_post}', [PostController::class, 'putLike']);

Route::get('home/getComments/{id_post}', [CommentController::class, 'getComments']);
Route::get('profile/getComments/{id_post}', [CommentController::class, 'getComments']);
Route::get('home/newComment/{id_post}/{content}', [CommentController::class, 'newComment']);
Route::get('profile/newComment/{id_post}/{content}', [CommentController::class, 'newComment']);

Route::get('news/getNews/{country}', [NewsController::class, 'getNews']);

Route::get('home/follow/{id_friend}', [FollowController::class, 'follow']);
Route::get('profile/follow/{id_friend}', [FollowController::class, 'follow']);
