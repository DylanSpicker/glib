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

Route::resource('topic', 'TopicController');
Route::auth();


Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');                                // Personal Dashboard
    Route::get('user/profile', 'UserController@showProfile')->name('profile');  // A users Profile when logged in
    Route::get('comment/rate/{id}/{rating}', 'CommentController@rate');         // Comment Rating 

    Route::get('issue', 'IssueController@index')->name('issue.index');
    Route::post('issue', 'IssueController@store')->name('issue.store');
    Route::get('issue/create', 'IssueController@create')->name('issue.create');
    Route::delete('issue/{issue}', 'IssueController@destroy')->name('issue.destroy');
    

    Route::get('argument', 'ArgumentController@index')->name('argument.index');
    Route::post('argument', 'ArgumentController@store')->name('argument.store');
    Route::get('argument/create', 'ArgumentController@create')->name('argument.create');
    Route::delete('argument/{argument}', 'ArgumentController@destroy')->name('argument.destroy');

});

/*
 * Regular "GET" Routes 
*/
Route::get('issue/{issue}', 'IssueController@show')->name('issue.show');
Route::get('argument/{argument}', 'ArgumentController@show')->name('argument.show');

Route::get('user/profile/{id}', 'UserController@showProfile');
Route::get("about", function(){ return view('about'); });
Route::get("donate", function(){ return view('donate'); });

Route::get('/', function () {
    if(Auth::check()) return Redirect::to('/home');
    return view('welcome');
});

Route::get('topics/random', function(){
    $rand = App\Topics::orderByRaw("RAND()")->first();
    return redirect('topic/'.$rand->id);
});