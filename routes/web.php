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

// Route::get('/', function () {
//     return view('/schedule');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/login', 'b4loginController@login');

// Route::post('/postlogin', 'b4loginController@postlogin');

// Route::get('/logout', 'b4loginController@logout');

// Route::get('/berhasil', 'b4loginController@berhasil')->middleware('auth');

Route::get('/loginbackoffice', 'backofficeController@login')->name('login');
Route::post('/postbackoffice', 'BackofficeController@postloginbackoffice');
Route::get('/logoutbackoffce', 'BackofficeController@logoutbackoffice');
Route::get('/user', function () {
    return view('welcome');
});
Route::get('/recruitementcandidate', 'BackofficeController@recruitment');
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return direct('/schedule');
    });
    Route::get('/dashboardbackoffice', 'BackofficeController@berhasil');
    Route::get('/schedule', 'BackofficeController@schedule');
    Route::get('/dashboardbackoffice', 'BackofficeController@berhasil');
    Route::post('/postcandidatelist', 'ScheduleController@store');
    /*
    Route::get('interview/{interview}', function ($id) {
        return 'User '.$id;
    });
    */
    Route::get('/link/{schedule}', 'ScheduleController@link');
    Route::post('/editschedule' , 'ScheduleController@update');
    Route::post('/editreschedule' , 'ScheduleController@reschedule');
    Route::post('/rejected' , 'ScheduleController@notattend')->middleware('can:isInterviewer');
    // Route::get('/interview' , 'InterviewController@index');
    Route::post('/interviewcreate' , 'InterviewController@store')->middleware('can:isInterviewer');
    // Route::post('/coba' , 'ScheduleController@coba');
    Route::get('/candidateform' , 'CandidateFormController@index');
    // Candidate Form
    Route::get('/details/{candidateForm}' , 'CandidateFormController@show');
    Route::get('/cari','CandidateFormController@cari');
    //Link
    Route::get('/getcandidatelist/{candidateid}','LinkController@getcandidatelist');
    Route::post('/linked/{candidatelistid}' , 'LinkController@store');

    Route::post('/notnew' , 'ScheduleController@nonew')->middleware('can:isRecruiter');
    Route::get('/getcandidatelistno/{candidatelistid}','ScheduleController@getcandidatelistno');
    Route::get('/yesnewcandidate', 'ScheduleController@formnewyes')->middleware('can:isRecruiter');
    Route::get('/nonewcandidate', 'ScheduleController@formnewno')->middleware('can:isRecruiter');
    Route::get('/forminterviewclient/{interview}', 'InterviewClientController@form')->middleware('can:isInterviewer');
    Route::get('/editnewcandidateschedule/{schedule}', 'ScheduleController@editnewcandidateschedule')->middleware('can:isRecruiter');
    Route::get('/notattend/{schedule}', 'ScheduleController@notattendview')->middleware('can:isInterviewer');
    
    Route::get('/carischedule','BackofficeController@cari');
    Route::get('/caricandidateschedule','CandidateListScheduleController@cari')->middleware('can:isInterviewer');
    Route::get('/candidatelistschedule','CandidateListScheduleController@index')->middleware('can:isInterviewer');
    Route::get('/history/{interviewid}','CandidateListScheduleController@history')->middleware('can:isInterviewer');
    Route::get('/checkhistory/{id}','HistoryController@show')->middleware('can:isInterviewer');
    Route::post('/interviewclient','InterviewClientController@store')->middleware('can:isInterviewer');
    
});

