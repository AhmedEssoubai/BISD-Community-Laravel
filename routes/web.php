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
/**
 * Global
 */
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/en_attente', function () {
    return view('pending');
})->name('pending')->middleware('not-pending');

Route::get('/apropos', function () {
    return view('about');
})->name('about');

/**
 * Groupe
 */
Route::get('/groupes', 'GroupesController@list')->name('groupes.list');
Route::get('/groupes/nouveau', 'GroupesController@create')->name('groupes.create');
Route::get('/groupes/{groupe}', 'GroupesController@show')->name('groupes.show');
Route::post('/groupes', 'GroupesController@store')->name('groupes');
Route::patch('/groupes/{groupe}', 'GroupesController@update')->name('groupes.update');
Route::get('/groupes/{groupe}/editer', 'GroupesController@edit')->name('groupes.edit');
Route::get('/groupes/{groupe}/en_attente', 'GroupesController@admin_pending')->name('groupes.pending');
Route::get('/groupes/{groupe}/members', 'GroupesController@members')->name('groupes.members');
Route::get('/groupes/{groupe}/join', 'GroupesController@join')->name('groupes.join');
Route::get('/groupes/{groupe}/{user}/leave', 'GroupesController@leave')->name('groupes.leave');
Route::get('/groupes/{groupe}/{user}/accept', 'GroupesController@accept_member')->name('groupes.accept');
Route::get('/groupes/d/{groupe}', 'GroupesController@destroy')->name('groupes.destroy');

/**
 * Post
 */
Route::post('/posts', 'PostsController@store')->name('posts');
Route::get('/posts/{post}/favorite', 'PostsController@favorite')->name('posts.favorite');
Route::get('/posts/{post}/bookmark', 'PostsController@bookmark')->name('posts.bookmark');
Route::get('/posts/{post}', 'PostsController@show')->name('posts.show');
Route::get('/posts/{post}/editer', 'PostsController@edit')->name('posts.edit');
Route::patch('/posts/{post}', 'PostsController@update')->name('posts.update');
Route::get('/posts/d/{post}', 'PostsController@destroy')->name('posts.destroy');

/**
 * Comment
 */
Route::get('/comments', 'CommentsController@create')->name('comments.create');
Route::get('/comments/{comment}/update', 'CommentsController@update')->name('comments.update');
Route::get('/comments/d/{comment}', 'CommentsController@destroy')->name('comments.destroy');

/**
 * Profil
 */
Route::get('/profils/{user}', 'ProfilController@show')->name('profils.show');
Route::get('/parametres/profil', 'ProfilController@edit')->name('profils.edit');
Route::get('/parametres/securite', 'ProfilController@security')->name('profils.edit.security');
Route::get('/parametres/compte', 'ProfilController@account')->name('profils.account');
Route::patch('/profils/securite/{user}', 'ProfilController@update_security')->name('profils.update.security');
Route::patch('/profils/{user}', 'ProfilController@update')->name('profils.update');

/**
 * Bookmark
 */
Route::get('/bookmarks/{user}', 'BookmarksController@show')->name('bookmarks.show');

/**
 * Admin
 */
Route::get('/admin/utilisateurs/en_attente', 'AdminController@pending_users')->name('admin.users.pending')->middleware('admin');
Route::get('/admin/utilisateurs/tout', 'AdminController@all_users')->name('admin.users.all')->middleware('admin');
Route::get('/admin/utilisateurs/accepter/{user}', 'AdminController@accept_user')->name('admin.users.accept')->middleware('admin');
Route::get('/users/d/{user}', 'AdminController@destroy_user')->name('admin.users.destroy');
Route::get('/admin/groupes/tout', 'AdminController@all_groupes')->name('admin.groupes.all')->middleware('admin');

/**
 * Search
 */
/*Route::get('/chercher/{value}', 'SearchController@show')->name('search.show');
Route::get('/chercher', 'SearchController@index')->name('search');*/
Route::get('/chercher', 'SearchController@index')->name('search');
