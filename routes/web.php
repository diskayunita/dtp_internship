<?php

/*
--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>'web'], function () {
    Route::get('/', 'HomeController@index');
    
    Route::get('/search', [ 'uses' => 'SearchController@search' ]);
    
    Route::get('/article', 'ArticleController@index')->name('all-article');
    Route::get('/article/{slug}', 'ArticleController@show')->name('single-article');
    Route::post('/article/search', 'ArticleController@search')->name('search-article');
    Route::post('/article/count/share', 'ArticleController@countShare')->name('article.count_share');
    
    Route::get('/showcase', 'ShowcaseController@index')->name('all-showcase');
    Route::get('/showcase/{slug}', 'ShowcaseController@show')->name('single-showcase');
    Route::post('/showcase/comment/{id}', 'ShowcaseController@comment')->name('comment_showcase');
    Route::post('/showcase/count/share', 'ShowcaseController@countShare')->name('showcase.count_share');
  
    Route::get('/about', 'AboutController@index')->name('about_page');
    
    Route::get('/gallery', 'GalleryController@index')->name('gallery_page');
    Route::get('/gallery/{id}', 'GalleryController@show')->name('gallery_detail');
    Route::get('/gallery/loadmore/{id}', 'GalleryController@loadmore');
  
    Route::get('/blog', 'HomeController@blog')->name('blog_page');

    Route::get('/survey/{referral_id}', 'SurveyController@show')->name('survey.show');
    Route::post('/survey/create/{id}/{referral_id}', 'SurveyController@store')->name('survey.store');
    
    Route::get('fullcalendar-ajax-events', 'HomeController@ajaxEvents')->name('fullcalendar-ajax-events');
    
    Route::get('language/{lang}', 'LanguageController')->name('language_option')->where('lang', implode('|', config('app.languages')));
    
    Route::post('/upload', 'HomeController@upload')->name('upload_elfinder');
    
    Route::resource('/event', 'EventController', ['except' => 'update']);
    Route::post('event/{id}', ['as'=>'event.update', 'uses'=>'EventController@update']);
    Route::get('event/response/{id}', ['as'=>'event.response','uses'=>'EventController@response']);
    Route::get('event/response/pdf/{id}', ['as'=>'event.response.pdf', 'uses'=>'EventController@responsePdf']);
  
    Route::get('/users/confirmation/{token}', 'Auth\RegisterController@confirmation')->name('confirmation');
    
    Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
    
    Route::get('testsms', function (\Nexmo\Client $nexmo) {
        $message = $nexmo->message()->send([ 'to' => '+6287822915636', 'from' => 'TelkomDSS', 'text' => 'Test sms from telkom DDS.']);
        Log::info('sent message: ' . $message['message-id']);
    });
});

Route::get('contact-us', function () {
    return View::make('contact.create');
})->name('contact_us');

Route::get('message', function () {
    return View::make('message.create');
})->name('message');

Route::get('calender', function () {
    return View::make('full-calender.index');
})->name('calender');

Route::get('login-register', function () {
    $register = false;
    $login = true;
    $forgot = false;
    return View::make('auth.login-register', compact('register', 'login', 'forgot'));
})->name('login-register');

Route::post('contact-us', 'ContactController@index')->name('contact_page');

Route::post('message', 'ContactController@index')->name('message_page');
Route::get('message/response/{id}', ['as'=>'message.response','uses'=>'ContactController@response']);

Route::group(['middleware'=>['web', 'auth']], function () {
    Route::post('comment-article/{id}', 'ArticleController@comment')->name('comment_article');
    Route::post('update-profile', 'UserController@updateProfile')->name('profile_update');
    Route::get('/myprofile', 'UserController@profile')->name('user.profile');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('admin_login');
    Route::post('/login', 'AdminAuth\LoginController@login');
    Route::get('/logout', 'AdminAuth\LoginController@logout');
    
    Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset');
    Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm');
    Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
