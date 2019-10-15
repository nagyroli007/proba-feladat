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

use App\Picture;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PictureController;
use Illuminate\Http\Request;

Route::get('/', 'MyController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/pictureviewer', 'HomeController@index')->name('pictureViewer');

/*Route::get('/pictureviewer', [
    'middleware' => ['auth'],
    'uses' => function () {
        echo "You are allowed to view this page!";
    }
]);
*/


Route::get('/pictureviewer', function() {
    return view('pictureViewer');
})->middleware('auth');




Route::get('picture', 'PictureController@showForm')->name('upload.picture');

Route::post('picture', 'PictureController@storePicture');

Route::get('pictureeditor/{picname}', function ($picname){
    //return view('pictureEditor');
    return view('pictureEditor')->with('picname', $picname);
});

Route::post('updateDesc/{picname}', function ($picname) {
    
    Picture::where('name', $picname)->where('username', auth()->user()->username)->update(['description' => $_POST['newdesc']]);

    return '<a href="/pictureviewer">Vissza a képekhez</a>';
});

Route::get('/deletepicture/{picname}', function ($picname) {
    PictureController::delete($picname);

    return '<a href="/pictureviewer">Vissza a képekhez</a>';
});

Route::post('replacepicture/{picname}', function (request $request, $picname) {
    PictureController::delete($picname);
    PictureController::storePicture($request);

    return '<a href="/pictureviewer">Vissza a képekhez</a>';
});