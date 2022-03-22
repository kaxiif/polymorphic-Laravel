<?php

use App\Models\Photo;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create',function(){

    $staff = Staff::find(1);
    $staff->photos()->create(['path'=>'exp.png']);
});


Route::get('/read',function(){
    $staff = Staff::findOrFail(1);
    foreach($staff->photos as $photo){
        return $photo->path;
    }

});

Route::get('/update', function(){
    $staff = Staff::findOrFail(1);
    $photo=$staff->photos()->whereId(1)->first();
    $photo->path="updated_exp_path.png";
    $photo->save();

});

Route::get('/delete', function(){
    $staff=Staff::findOrFail(1);
    $staff->photos()->whereId(1)->delete();

});


Route::get('/assign', function(){
    $staff = Staff::findOrFail(1);

    $photo = Photo::findOrFail(5);

    $staff->photos()->save($photo);

});


Route::get('/un-assign', function(){
    $staff = Staff::findOrFail(1);

    

    $staff->photos()->whereId(5)->update(['imageable_id'=>0, 'imageable_type'=>'']);

});