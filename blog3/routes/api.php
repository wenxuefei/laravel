<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::any('/timeLine','CommenController@timeLine');
Route::get('/sign', function () {
    $user = new \App\Models\User();
    return $user->signUp();
});

Route::any('/change_password',function (){
    $user = new \App\Models\User();
    return $user->change_password();
});
Route::any('/find_password',function (){
    $user = new \App\Models\User();
    return $user->find_password();
});

Route::get('/login',function (){
    $user = new \App\Models\User();
    return $user->login();
});

Route::any('/logout',function (){
    $user = new \App\Models\User();
    return $user->logout();
});

Route::any('/is_login',function (){
    $user = new \App\Models\User();
    return $user->is_login();
});

Route::any('/question/create',function (){
    $question = new \App\Models\Question();
    return $question->createQuestion();
});

Route::any('/question/update',function (){
    $question = new \App\Models\Question();
    return $question->changeQuestion();
});

Route::any('/question/show',function (){
    $question = new \App\Models\Question();
    return $question->showQuestion();
});


Route::any('/question/destroy',function (){
    $question = new \App\Models\Question();
    return $question->destroyQuestion();
});

Route::any('/answer/create',function (){
    $answer = new \App\Models\Answer();
    return $answer->createAnswer();
});
Route::any('/answer/update',function (){
    $answer = new \App\Models\Answer();
    return $answer->changeAnswer();
});

Route::any('/answer/show',function (){
    $answer = new \App\Models\Answer();
    return $answer->showAnswer();
});

Route::any('/comment/create',function (){
    $comment = new \App\Models\Comment();
    return $comment->createComment();
});
Route::any('/comment/show',function (){
    $comment = new \App\Models\Comment();
    return $comment->showComment();
});
Route::any('/comment/destroy',function (){
    $comment = new \App\Models\Comment();
    return $comment->destroyComment();
});

Route::any('/vote',function (){
    $answer = new \App\Models\Answer();
    return $answer->vote();
});
