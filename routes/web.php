<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');

    Route::get('profile', 'ProfileController@index')->name('profile');
    Route::patch('profile/update', 'ProfileController@update')->name('profile.update');

    Route::post('file','FileController@store');
    Route::get('file/{uuid}/download','FileController@downloadFile')->name('file.download');
    Route::delete('file/{uuid}/destroy','FileController@destroy')->name('file.destroy');

    Route::post('activities', 'ActivitiesController@add')->name('activities.add');
    Route::get('activities/{id}/show', 'ActivitiesController@show')->name('activities.show');
    Route::get('activities/{id}/edit', 'ActivitiesController@edit')->name('activities.edit');
    Route::get('activities/{id}', 'ActivitiesController@update')->name('activities.update');
    Route::delete('activities/{id}', 'ActivitiesController@destroy')->name('activities.destroy');

    //Route::get('dropzone', 'DropzoneController@index')->name('dropzone');
    //Route::post('dropzone/upload', 'DropzoneController@upload')->name('dropzone.upload');
    //Route::get('dropzone/fetch', 'DropzoneController@fetch')->name('dropzone.fetch');
    //Route::get('dropzone/delete', 'DropzoneController@delete')->name('dropzone.delete');

});


#Route::get('/users/fileupload/','UserController@index')->name('users.fileupload.index');
#Route::post('/users/fileupload/','UserController@fileupload')->name('users.fileupload');

#Route::get('file', 'FileController@create')->name('file.create');
#Route::post('file', 'FileController@store')->name('file.store');

Route::get('/', function () {
    return view('/home');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('fullcalendar','FullCalendarController@index');
Route::post('fullcalendar/create','FullCalendarController@create');
Route::post('fullcalendar/update','FullCalendarController@update');
Route::post('fullcalendar/delete','FullCalendarController@destroy');
Route::get('fullcalendar/{id}', 'FullCalendarController@show');

Route::post('eventSub', 'EventSignupController@sub');
Route::post('eventUnsub', 'EventSignupController@unsub');

Route::get('send-unsubbed-mail', function() {
    $details = [
        'title' => 'Mail envoyé par ptnobleguillot.test',
        'body' => 'Test pd'
    ];

    Mail::to('guigou.guillot@gmail.com')->send(new \App\Mail\UnsubbedMailer($details));
});
