<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/', [
    'uses' =>'ForumsController@index',
    'as' => 'forum'
]);

Route::get('/forum', [
	'uses' =>'ForumsController@index',
	'as' => 'forum'
]);

Route::get('/channel/{slug}', [
        'uses'=> 'ForumsController@show',
        'as' => 'channel'
]);

Route::get('/discussion/{slug}', [
        'uses'=> 'DiscussionsController@show',
        'as' => 'discussion'
]);


Route::group(['middleware' => 'auth'], function(){
	Route::resource('channels', 'ChannelsController');
    
    Route::get('/discussion/create/new', [
        'uses'=> 'DiscussionsController@create',
        'as' => 'discussion.create'
    ]);
    
    Route::post('/discussion/store', [
        'uses'=> 'DiscussionsController@store',
        'as' => 'discussion.store'
    ]);

    Route::post('/discussion/reply/{id}', [
        'uses'=> 'DiscussionsController@reply',
        'as' => 'discussion.reply'
    ]);

    Route::get('/reply/like/{id}', [
        'uses'=> 'RepliesController@like',
        'as' => 'reply.like' 
    ]);


    Route::get('/reply/unlike/{id}', [
        'uses'=> 'RepliesController@unlike',
        'as' => 'reply.unlike' 
    ]);

    Route::get('/discussion/watch/{id}', [
        'uses'=> 'WatchersController@watch',
        'as' => 'discussion.watch' 
    ]);

    Route::get('/discussion/unwatch/{id}', [
        'uses'=> 'WatchersController@unwatch',
        'as' => 'discussion.unwatch' 
    ]);
});