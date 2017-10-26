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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('about',function(){
// 	echo 'about us';
// 	return view('about-us');
// });

// Route::get('page/contact-us',function(){

// 	$data=[
//            'fname'=>'Ram',
//            'location'=>[

//            					'country'=>'Nepal',
//            					'city'=>'ktm',
//            					'street'=>'Aloknagar,<br>Binayak samjhana Marga,<strong>#96</strong>'
//                      ]
         
// 	   ];
//   return view('page/contact-us',$data);
// });


// Route::get('page/faq','PageController@faq');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@index');
Route::get('/session/test','IndexController@detail');

// Route::get('admin/dashboard','Admin\DashboardController@index');
// Route::get('admin/product/add','Admin\ProductController@add');
// Route::get('admin/category','Admin\CategoryController@index');
// Route::get('admin/category/add','Admin\CategoryController@add');
// Route::post('admin/category/postadd','Admin\CategoryController@postAdd');
// Route::get('admin/category/edit/{id}','Admin\CategoryController@edit');
// Route::post('admin/category/update/{id}','Admin\CategoryController@update');
// Route::get('admin/category/delete/{id}','Admin\CategoryController@delete');

Route::group(['prefix'=>'admin', 'middleware'=>'auth'],function(){

Route::get('dashboard','Admin\DashboardController@index');
Route::get('category','Admin\CategoryController@index');
Route::get('category/add','Admin\CategoryController@add');
Route::post('category/postadd','Admin\CategoryController@postAdd');
Route::get('category/edit/{id}','Admin\CategoryController@edit');
Route::post('category/update/{id}','Admin\CategoryController@update');
Route::get('category/delete/{id}','Admin\CategoryController@delete');

Route::resource('product','admin\ProductController');

Route::resource('brand','admin\BrandController');
Route::resource('slider','admin\SliderController');

Route::resource('featured','admin\FeaturedController');
Route::get('featured/ajaxproduct/{category_id}', 'Admin\FeaturedController@ajaxProduct');

Route::resource('page','admin\PageController');




});
Route::group(['prefix'=>'pages', 'middleware'=>'web'], function(){
     Route::get('contact','PageController@contact');
     Route::get('{slug}', 'PageController@content');
});

Route::get('/category/{slug}/product', 'ProductController@index');
Route::group(['prefix'=>'product', 'middleware'=>'web'], function(){
     Route::get('/','ProductController@index');
     
});

