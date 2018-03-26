<?php
	Route::get('/', function () {
	$users[] = Auth::user();
	$users[] = Auth::guard()->user();
	$users[] = Auth::guard('admin')->user();
	
	return redirect(action('Admin\HomeController@index'));
}
)->name('dashboards');

Route::get('/home', function () {
	$users[] = Auth::user();
	$users[] = Auth::guard()->user();
	$users[] = Auth::guard('admin')->user();
	
	return redirect(action('Admin\HomeController@index'));
}
)->name('home');

Route::get('/', 'Admin\HomeController@index')->name('dashboards');
// Route Content
	Route::group(['prefix' => 'content'], function () {
	// 	SubDomain Content
	
	// 	SubDomain Route Content : Category
			Route::resource('/category', 'Admin\CategoryController', ['except' => 'update']);
	
	Route::post('/category/{id}', 'Admin\CategoryController@update')->name('update_category');
	
	// 	SubDomain Route Content : Gallery
			Route::resource('/gallery', 'Admin\GalleryController', ['except'=>'update']);
	
	Route::post('/gallery/{id}', 'Admin\GalleryController@update')->name('update_gallery');
	
	Route::get('/gallery/{id}/publish', 'Admin\GalleryController@publish')->name('gallery.publish');
	
	Route::get('/gallery/{id}/unpublish', 'Admin\GalleryController@unpublish')->name('gallery.unpublish');
	
	// 	SubRoute Route Content : Article
			Route::resource('/article', 'Admin\ArticleController', ['except' => 'update']);
	
	Route::post('/article/{id}', 'Admin\ArticleController@update')->name('update_article');
	
	Route::get('/article/{id}/hightlight', 'Admin\ArticleController@hightlight')->name('article.hightlight');
	
	Route::get('/article/{id}/unhightlight', 'Admin\ArticleController@unhightlight')->name('article.unhightlight');
	
	Route::get('/article/{id}/publish', 'Admin\ArticleController@publish')->name('article.publish');
	
	Route::get('/article/{id}/unpublish', 'Admin\ArticleController@unpublish')->name('article.unpublish');
	Route::get('/article/preview/{id}', 'Admin\ArticleController@showPreview')->name('article.preview');
	Route::get('/article/preview', 'Admin\ArticleController@preview')->name('article.post.preview');
	
	// 	SubRoute Route Content : Product
			Route::resource('/showcase', 'Admin\ShowcaseController', ['except' => 'update']);
	Route::post('/showcase/{id}', 'Admin\ShowcaseController@update')->name('update_showcase');
	Route::get('/showcase/{id}/publish', 'Admin\ShowcaseController@publish')->name('showcase.publish');
	Route::get('/showcase/{id}/unpublish', 'Admin\ShowcaseController@unpublish')->name('showcase.unpublish');
	Route::get('/showcase/preview/{id}', 'Admin\ShowcaseController@showPreview')->name('showcase.preview');
	Route::get('/showcase/preview', 'Admin\ShowcaseController@preview')->name('showcase.post.preview');
}
);

// Route Kunjungan
	Route::group(['prefix' => 'kunjungan'], function () {
	// 	SubDomain Kunjungan
	
	// 	SubDomain Route Kunjungan : Kunjungan
			Route::resource('/event', 'Admin\EventController');
	
	Route::post('/event/{id}', 'Admin\EventController@update')->name('update_event');
	
	Route::post('/event/{id}/responses', 'Admin\EventController@eventresponse')->name('event_response');
	Route::get('/event/export/pdf', 'Admin\EventController@exportPdf')->name('event_pdf');
	Route::get('/event/export/excel', 'Admin\EventController@exportExcel')->name('event_excel');
	Route::get('/config/event', 'Admin\EventController@config')->name('event_config');
	Route::post('/config/event/store', 'Admin\EventController@storeConfig')->name('event_config_store');
	Route::get('/create-event', 'Admin\EventController@createEvent')->name('create_event');
	Route::post('/store-event', 'Admin\EventController@storeEvent')->name('store_event');
	
	// 	SubDomain Route Kunjungan : Purpose
			Route::resource('/purpose', 'Admin\PurposeController', ['except' => 'update']);
	
	Route::patch('/purpose/{purpose}/update', 'Admin\PurposeController@update')->name('update_purpose');
	
	// 	SubDomain Route Kunjungan : Product
			Route::resource('/product', 'Admin\ProductController', ['except' => 'update']);
	Route::patch('/product/{product}/update', 'Admin\ProductController@update')->name('update_product');
	
	// 	SubDomain Route Kunjungan : Agency
			Route::resource('/university', 'UniversityController', ['except' => 'update']);
	Route::post('/university/update/{id}', 'UniversityController@update')->name('update_university');
	
	// 	SubDomain Route Kunjungan : LImit of Participant
			Route::resource('/participant', 'Admin\ParticipantLimitController', ['except' => 'update']);
	Route::post('/participant/update/{id}', 'Admin\ParticipantLimitController@update')->name('update_participant');
	
	// 	SubDomain Route Kunjungan : Event Type
			Route::resource('/type', 'Admin\EventTypeController', ['except' => 'update']);
	
	Route::post('/type/{id}', 'Admin\EventTypeController@update')->name('update_type');
	
	// 	SubDomain Route Kunjungan : Blocked Date
			Route::resource('/blokeddate', 'Admin\DateBlockedController', ['except' => 'update']);
	
	Route::post('/blokeddate/{id}', 'Admin\DateBlockedController@update')->name('update_blockeddate');
	
}
);

// Route User
	Route::group(['prefix' => 'user'], function () {
	// 	SubDomain 
	
	// 	SubDomain Route User : Role
			Route::resource('/role', 'Admin\RoleController', ['except' => 'update', 'middleware' => ['role:superadmin']]);
	
	Route::post('/role/{id}', 'Admin\RoleController@update', ['middleware' => ['role:superadmin']])->name('update_role');
	
	// 	SubDomain Route User : Permission
			Route::resource('/permission', 'Admin\PermissionController', ['except' => 'update', 'middleware' => ['role:superadmin']]);
	
	Route::post('/permission/{id}', 'Admin\PermissionController@update', ['middleware' => ['role:superadmin']])->name('update_permission');
	
	// 	SubDomain Route User :  Admin
			Route::resource('/manage', 'Admin\AdminController', ['except' => 'update'], ['middleware'=>['role:superadmin']]);
	
	Route::post('/manage/{id}', 'Admin\AdminController@update')->name('update_admin');
	
	Route::post('/admin/{id}/manage-permission/{method}/{permission_id}', 'Admin\AdminController@permission', ['middleware' => ['role:superadmin']])->name('manage_permission');
	
	// 	SubDomain Route User : Non Admin
			Route::resource('/non-admin', 'Admin\UserController', ['except' => 'update']);
	
	Route::post('/non-admin/{id}', 'Admin\UserController@update')->name('update_user');
}
);

Route::resource('/slider', 'Admin\SliderController', ['except'=>'update']);

Route::post('/slider/{id}', 'Admin\SliderController@update')->name('update_slider');

Route::get('/slider/{id}/publish', 'Admin\SliderController@publish')->name('slider.publish');

Route::get('/slider/{id}/unpublish', 'Admin\SliderController@unpublish')->name('slider.unpublish');


Route::resource('/contact', 'Admin\ContactController', ['except' => 'update']);

Route::post('/contact/{id}/reply', 'Admin\ContactController@reply')->name('reply_contact');


Route::resource('/about', 'Admin\AboutController');

Route::post('/about/{id}', 'Admin\AboutController@update')->name('update_about');

Route::resource('/division', 'Admin\DivisionController');

Route::post('/division/{id}', 'Admin\DivisionController@update')->name('update_division');

Route::resource('/crew', 'Admin\CrewController', ['except' => 'update']);
Route::patch('/crew/{id}/update', 'Admin\CrewController@update')->name('update_crew');


/* Survey Routes */
Route::resource('/survey', 'Admin\SurveyController');
Route::get('/survey/{survey}', 'Admin\SurveyController@show')->name('detail_survey');
Route::get('/survey/export/pdf', 'Admin\SurveyController@exportPdf')->name('survey_pdf');
Route::get('/survey/export/excel', 'Admin\SurveyController@exportExcel')->name('survey_excel');
Route::post('/survey/{survey}/update', 'Admin\SurveyController@update')->name('update_survey');
Route::get('/survey/{id}/publish', 'Admin\SurveyController@publish')->name('survey.publish');
Route::get('/survey/{id}/unpublish', 'Admin\SurveyController@unPublish')->name('survey.unpublish');
Route::post('/survey/{survey}/questions', 'Admin\QuestionController@store')->name('store_question');
Route::get('/survey/{id}/answer', 'Admin\SurveyController@getAnswer')->name('get_answer');
Route::get('/answer/{id}/export/pdf', 'Admin\SurveyController@answerPdf')->name('answer_pdf');
Route::get('/answer/{id}/export/excel', 'Admin\SurveyController@answerExcel')->name('answer_excel');

/* Question Routes */
Route::get('/question/{question}/edit', 'Admin\QuestionController@edit')->name('edit_question');
Route::patch('/question/{question}/update', 'Admin\QuestionController@update')->name('update_question');
Route::delete('/question/{question}/delete', 'Admin\QuestionController@destroy')->name('delete_question');
