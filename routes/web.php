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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/question', 'QuestionController@store');
Route::delete('/pertanyaan/{question}', 'QuestionController@destroy');
Route::get('/pertanyaan/{question}/edit', 'QuestionController@edit');
Route::patch('/pertanyaan/{question}', 'QuestionController@update');

Route::post('/questionComment', 'QuestionCommentController@store');
Route::delete('/questionComment/{questionComment}', 'QuestionCommentController@destroy');
Route::get('/questionComment/{questionComment}/edit', 'QuestionCommentController@edit');
Route::patch('/questionComment/{questionComment}', 'QuestionCommentController@update');


Route::post('/answer', 'AnswerController@store');
Route::get('/jawaban/{answer}/edit', 'AnswerController@edit');
Route::patch('/jawaban/{answer}', 'AnswerController@update');
Route::delete('/jawaban/{answer}', 'AnswerController@destroy');

Route::post('/answerComment', 'AnswerCommentController@store');
Route::delete('/answerComment/{question}', 'AnswerCommentController@destroy');
Route::get('/answerComment/{question}/edit', 'AnswerCommentController@edit');
Route::patch('/answerComment/{question}', 'AnswerCommentController@update');
