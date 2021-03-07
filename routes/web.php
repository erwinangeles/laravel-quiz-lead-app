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





Route::get('quiz/{slug}', 'ViewQuizController@show')->name('view.quiz');
Route::get('quiz/{slug}/step/{question}', 'ViewQuizController@step')->name('view.quizstep');
Route::get('quiz/{slug}/complete', 'ViewQuizController@complete')->name('quiz.complete');
Route::get('thank-you', 'ViewQuizController@thankyou')->name('thankyou');

Route::post('send/email/{quiz}', 'NotificationEmailController@sendMail')->name('mail.send');


Route::group(['middleware' => ['basicAuth']], function () {
    //
    Route::prefix('qadmin')->group(function () {
        Route::resource('quizzes', 'QuizController');
        Route::get('quiz/{quiz}/questions', 'QuizController@manageQuestions')->name('quizzes.questions.manage');
        Route::get('quiz/questions/edit/{question}', 'QuizController@editQuestion')->name('quizzes.questions.edit');
        Route::post('quiz/questions/edit/{question}', 'QuizController@updateQuestion')->name('quizzes.questions.update');
        Route::post('quiz/{quiz}/addQuestion', 'QuizController@addQuestion')->name('quizzes.questions.add');
        Route::post('quiz/deleteQuestion/{question}', 'QuizController@deleteQuestion')->name('quizzes.questions.destroy');
        Route::get('quiz/answers/{question}', 'QuizController@manageAnswers')->name('quizzes.answers.manage');
        Route::post('quiz/question/{question}/addAnswer', 'QuizController@addAnswer')->name('quizzes.answers.add');
        Route::post('quiz/deleteAnswer/{answer}', 'QuizController@deleteAnswer')->name('quizzes.answers.destroy');
        
    });
});