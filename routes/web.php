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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@index')->middleware('rc');
Route::get('/sessoin/test', 'IndexController@detail');



Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function() {
	// http://phplaravel/admin/banner
	// Route::get('banner', 'Admin\BannerController@index');

	Route::get('dashboard', 'Admin\DashboardController@index');

	Route::resource('product', 'Admin\ProductController'); // Resourceful routing for product controller

	Route::resource('category', 'Admin\CategoryController'); // Resourceful routing for category controller

    Route::resource('brand', 'Admin\BrandController'); // Resourceful routing for brand controller

    Route::resource('slider', 'Admin\SliderController'); // Resourceful routing for slider controller

    Route::resource('featured', 'Admin\FeaturedController'); // Resourceful routing for featured controller

    Route::resource('pages', 'Admin\PagesController'); // Resourceful routing for pages controller

    Route::get('featured/ajaxproduct/{category_id}', 'Admin\FeaturedController@ajaxProduct'); // this is the route for the ajax request

});

Route::group(['prefix'=>'pages', 'middleware'=>'web'], function() {
	Route::get('contact', 'PageController@contact');
	Route::get('{slug}', 'PageController@content');
});

Route::get('/category/{slug}/product', 'ProductController@index');

Route::group(['prefix'=>'product', 'middleware'=>'rc:admin'], function() {

	// All product list - <domain>/product
	Route::get('/', 'ProductController@index');


	// all product list by category - <domain>/product/{category}
	// http://phplaravel/product/mobile

	// product detail - <domain>/product/{product}

	// Route::get
});


Route::group(['prefix'=>'cart', 'middleware'	=>	'web'], function() {
	Route::get('add/{id}', 'CartController@add');
	Route::get('index', 'CartController@index');
	Route::post('update', 'CartController@update');
	Route::get('remove/{id}', 'CartController@remove');
});


Route::get('order/checkout', 'OrderController@checkout');

