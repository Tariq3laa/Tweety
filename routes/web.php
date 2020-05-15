<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/tweets', 'TweetController@index')->name('home');
    Route::post('/tweets', 'TweetController@store')->name('tweet');

    Route::post('/tweets/{tweet}/like', 'TweetLikesController@store')->name('like');
    Route::delete('/tweets/{tweet}/like', 'TweetLikesController@destroy')->name('dislike');

    Route::post(
        '/profiles/{user:username}/follow',
        'FollowsController@store'
    )->name('follow');

    Route::get(
        '/profiles/{user:username}/edit',
        'ProfilesController@edit'
    )->middleware('can:edit,user');

    Route::patch(
        '/profiles/{user:username}',
        'ProfilesController@update'
    )->middleware('can:edit,user');

    Route::get('/explore', 'ExploreController')->name("explore");
});

Route::get('/profiles/{user:username}', 'ProfilesController@show')->name(
    'profile'
);

Route::get('test', function () {
    $h=\Hash::make('123456789');
    $pass='123456789';
    $ha=\DB::table('users')->where('id', '=', 3)->value('password');
    if (\Hash::check(123456789, $ha)==true) {
        if (\Hash::check(123456789, $ha)==true) {
            return "Done";
        }
        return "Don";
    }
    
});