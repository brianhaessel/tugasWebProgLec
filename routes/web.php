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

// Accessible by anyone
Auth::routes();
Route::get('/', function() {
	return redirect('home');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/search', 'HomeController@search')->name('search');
Route::get('/post/{id}', 'PostController@view');

// Accessible by User/Admin
Route::middleware(['auth'])->group(function() {
	// Posts/Home
	Route::get('/followed_brands', 'HomeController@followedBrands')->name('followed_brands');
	Route::get('/myposts', 'HomeController@myPosts')->name('myposts');
	Route::get('/add', 'PostController@add');
	Route::post('/insert', 'PostController@store')->name('insert');
	Route::post('/addComment', 'PostController@addComment');
	Route::delete('/deletePost/{post}', 'PostController@destroy')->name('delete');

	// Transactions
	Route::get('/cart', 'TransactionController@index')->name('cart');
	Route::get('/transactionHistory','TransactionController@transactionHistory')->name('transaction_history');
	Route::post('/addToCart/{id}', 'TransactionController@addToCart')->name('addToCart');
	Route::post('/removeFromCart/{id}', 'TransactionController@removeFromCart')->name('removeFromCart');
	Route::post('/checkout', 'TransactionController@checkout')->name('checkout');

	// User
	Route::get('/profile', 'UserController@profile')->name('profile');
	Route::get('/followedBrand', 'UserController@followedBrand');
	Route::patch('/updateProfile', 'UserController@update')->name('updateProfile');
	Route::post('/updateFollowBrand', 'UserController@updateFollowBrand')->name('updateFollowBrand');
});

// Accessible by Admin
Route::middleware(['admin'])->group(function() {
	Route::get('/manageUser','UserController@manageUser')->name('manage_user');
	Route::get('/manageBrand', 'BrandController@index')->name('manage_brand');
	Route::get('/allTransaction', 'TransactionController@allTransaction')->name('all_transaction');
	Route::get('/addBrand','BrandController@addBrand')->name('add_brand');
	Route::post('/insertBrand', 'BrandController@store')->name('insert_brand');

	Route::get('/editUser/{id}', 'UserController@editUser')->name('edit_user');
	Route::get('/editBrand/{id}', 'UserController@editBrand')->name('edit_brand');
	Route::patch('/updateProfile/{user}', 'UserController@updateAdmin')->name('updateProfileAdmin');
	Route::patch('/updateBrand/{brand}', 'BrandController@updateBrand')->name('update_brand');
	Route::delete('/deleteUser/{user}', 'UserController@delete')->name('delete_user');
	Route::delete('/deleteBrand/{brand}', 'BrandController@deletebrand')->name('delete_brand');
});