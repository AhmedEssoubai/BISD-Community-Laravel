<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/groupe/{groupe}', 'GroupesController@show')->name('groupe.show');

Route::post('/groupes', 'GroupesController@store')->name('groupe');

Route::get('/groupes/nouveau', 'GroupesController@create')->name('groupes.create');


Route::post('/posts', 'PostsController@store')->name('posts');

Route::get('/post/{post}', 'PostsController@show')->name('posts.show');

Route::get('/post/favorite', 'PostsController@favorite')->name('post.favorite');

Route::get('/comments', 'CommentsController@create')->name('comments.create');

Route::get('/profil/{user}', 'ProfilController@show')->name('profil.show');
