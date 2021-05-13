<?php

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', 'App\Http\Controllers\UserExploitController@home')->name('dashboard')->middleware('roleCheck');

Route::get('/','App\Http\Controllers\UserExploitController@index');
Route::get('/quit254','App\Http\Controllers\UserExploitController@logout');
Route::POST('/message','App\Http\Controllers\UserExploitController@sms')->name('sendMessage');

    Route::middleware(['admin'])->group(function(){//admin routes will goes here
        Route::get('/adminDashboard','App\Http\Controllers\AdminController@index');
        Route::get('/adminAddUser','App\Http\Controllers\AdminController@addUser');
        Route::POST('/adminAddUser','App\Http\Controllers\AdminController@storeUser')->name('storeUser');
        Route::get('/adminAddPrimary','App\Http\Controllers\AdminController@addPrimary');
        Route::POST('/adminAddPrimary','App\Http\Controllers\AdminController@addPrimaryFunction')->name('addPrimary');
        Route::get('/adminAddSecondary','App\Http\Controllers\AdminController@addSecondary');
        Route::POST('/adminAddSecondary','App\Http\Controllers\AdminController@addSecondaryFunction')->name('addSecondary');
        Route::get('/adminAddMark','App\Http\Controllers\AdminController@addMark');
        Route::POST('/adminAddMark','App\Http\Controllers\AdminController@addMarkFunction')->name('addMark');
        Route::get('/adminshowusers','App\Http\Controllers\AdminController@showUser')->name('showUsers');
        Route::get('/adminSearchUser','App\Http\Controllers\AdminController@searchUser')->name('searchUsers');
        Route::get('/admindelete/{id}','App\Http\Controllers\AdminController@destroyUser')->name('adminDelete');
        Route::get('/adminupdate/{id}','App\Http\Controllers\AdminController@updateUser');
        Route::POST('/adminupdateuser','App\Http\Controllers\AdminController@updateUserDetails')->name('adminUpdateuser');
        /* primary */
        Route::get('/adminshowPrimary','App\Http\Controllers\AdminController@showPrimary')->name('showPrimary');
        Route::get('/adminSearchPrimary','App\Http\Controllers\AdminController@searchPrimary')->name('searchPrimary');
        Route::get('/admindeletePrimary/{id}','App\Http\Controllers\AdminController@destroyPrimary')->name('destroyPrimary');
        Route::get('/adminupdateprimary/{id}','App\Http\Controllers\AdminController@updatePrimary');
        Route::POST('/adminupdateprimary','App\Http\Controllers\AdminController@updatePrimaryDetails')->name('adminupdatePrimary');
        /* secondary */
        Route::get('/adminshowSecondary','App\Http\Controllers\AdminController@showSecondary')->name('showSecondary');
        Route::get('/adminSearchSecondary','App\Http\Controllers\AdminController@searchSecondary')->name('searchSecondary');
        Route::get('/admindeleteSecondary/{id}','App\Http\Controllers\AdminController@destroySecondary')->name('destroySecondary');
        Route::get('/adminupdatesecondary/{id}','App\Http\Controllers\AdminController@updateSecondary');
        Route::POST('/adminupdateSecondary','App\Http\Controllers\AdminController@updateSecondaryDetails')->name('adminupdateSecondary');
        /* marks */
        Route::get('/adminshowMarks','App\Http\Controllers\AdminController@showScores')->name('showScores');
        Route::get('/adminSearchMark','App\Http\Controllers\AdminController@searchMark')->name('searchMark');
        Route::get('/admindeleteMark/{id}','App\Http\Controllers\AdminController@destroyMark')->name('destroyMark');
        Route::get('/adminupdatemark/{id}','App\Http\Controllers\AdminController@updateMark');
        Route::POST('/adminupdateMarks','App\Http\Controllers\AdminController@updateMarkDetails')->name('updateMarkDetails');
        /* messages */
        Route::get('/adminshowMessages','App\Http\Controllers\MessageController@adminShowMessage')->name('adminShowMessage');
        Route::get('/adminShowReply/{id}','App\Http\Controllers\MessageController@adminReply')->name('adminReply');
        Route::POST('/adminSendReply','App\Http\Controllers\MessageController@adminSendReply')->name('adminSendReply');
        Route::get('/adminDestroysms/{id}','App\Http\Controllers\MessageController@destroysms')->name('destroysms');
        
        /* assingment */
        Route::get('/adminAssignStudents','App\Http\Controllers\AdminController@assignment');
        Route::get('/adminshowAllocated','App\Http\Controllers\AdminController@allocated');
        Route::get('/adminSearchAllocated','App\Http\Controllers\AdminController@searchAllocated')->name('searchAllocated');
        Route::get('/adminDestroyAllocated/{id}','App\Http\Controllers\AdminController@destroyAllocation')->name('destroyAllocation');
       });
    
    Route::middleware(['headTeacher'])->group(function(){
        Route::get('/mySchool','App\Http\Controllers\HeadteacherController@index');
        Route::get('/mySchoolDashboard','App\Http\Controllers\HeadteacherController@dashboard');
        Route::get('/mySchoolAdd','App\Http\Controllers\HeadteacherController@addStudent');
        Route::POST('/mySchoolAdd','App\Http\Controllers\HeadteacherController@storeStudent')->name('addStudent');
        Route::get('/mySchoolList','App\Http\Controllers\HeadteacherController@studentList');
        Route::get('/myMessages','App\Http\Controllers\HeadteacherController@hdMessages');
        Route::get('/MyReply/{id}','App\Http\Controllers\MessageController@HTReply')->name('HTReply');
        Route::POST('/HTSendReply','App\Http\Controllers\MessageController@htSendReply')->name('htSendReply');
        Route::get('/Destroysms/{id}','App\Http\Controllers\MessageController@HDdestroysms')->name('HDdestroysms');
        });
    Route::middleware(['pupil'])->group(function(){
        Route::get('/stuDashboard','App\Http\Controllers\UserExploitController@home');
        Route::POST('/selection','App\Http\Controllers\UserExploitController@storeSelection')->name('sendSelection');
        /* messages */
        Route::get('/studentshowMessages','App\Http\Controllers\MessageController@studentShowsms')->name('studentShowsms');
        Route::POST('/studentSendMessage','App\Http\Controllers\MessageController@studentSendsms')->name('studentSendsms');
        Route::get('/studentDestroysms/{id}','App\Http\Controllers\MessageController@studestroysms')->name('studestroysms');
         });





