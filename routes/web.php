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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users', function (){
    return [
        'users'=>\App\User::orderBy('id')->get(['name','email'])

    ];
});
Route::delete('/users/{user}', function(\App\User $user){
    $user->delete();
    return \Illuminate\Http\Response::create('',204);
});
Route::post('users', function(\Illuminate\Http\Request $request){
    $user = User::create($request->only(['name','email']));
    return response($user->only(['id','name','email']), 201);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/settings/security', function () {
    // Users must confirm their password before continuing...
})->middleware(['auth', 'password.confirm']);
/*Route::get('/register/verify', function () {
    // Users must confirm their password before continuing...
})->middleware(['auth', 'verification.verify']);*/
Route::get('/products', function () {

    return view('products', ['products' => \App\Product::all() ] );
});
Route::get('/product/{product}', function (\App\Product $product) {

    return view('info', ['product' => $product ] );
});
/*Route::get('/products', function () {

    return view('info');
});
*/
//Route::get('/profil', 'ProfilController@index')->name('profil');

