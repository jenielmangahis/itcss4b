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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/admin-lte', function () {
    return view('admin_template');
});
Route::get('/admin-lte-login', function () {
    return view('admin_login');
});
Route::get('/lte_fixed', 'BenchmarkController@lte_fixed')->name('lte_fixed');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

//Dashboard Module
Route::get('dashboard', ['as'=>'dashboard','uses'=>'DashboardController@index'])->middleware('auth');
Route::get('/', ['as'=>'/','uses'=>'DashboardController@index'])->middleware('auth');

//User Module
Route::get('/users', ['as'=>'users','uses'=>'UserController@index'])->middleware('auth');
Route::get('user/profile', ['as'=>'user/profile','uses'=>'UserController@profile'])->middleware('auth');
Route::post('user/update_profile', ['as'=>'user/update_profile','uses'=>'UserController@updateProfile'])->middleware('auth');
Route::get('user/create', ['as'=>'user/create','uses'=>'UserController@create'])->middleware('auth');
Route::post('user/store', ['as'=>'user/store','uses'=>'UserController@store'])->middleware('auth');
Route::get('user/edit/{user_id}', ['as'=>'user/edit','uses'=>'UserController@edit'])->middleware('auth');
Route::post('user/update', ['as'=>'user/update','uses'=>'UserController@update'])->middleware('auth');
Route::post('user/destroy', ['as'=>'user/destroy','uses'=>'UserController@destroy'])->middleware('auth');

//Company Users Module
Route::get('/company_users', ['as'=>'company_users','uses'=>'CompanyUserController@index'])->middleware('auth');
Route::get('company_users/create', ['as'=>'company_users/create','uses'=>'CompanyUserController@create'])->middleware('auth');
Route::post('company_users/store', ['as'=>'company_users/store','uses'=>'CompanyUserController@store'])->middleware('auth');
Route::get('company_users/edit/{user_id}', ['as'=>'company_users/edit','uses'=>'CompanyUserController@edit'])->middleware('auth');
Route::post('company_users/update', ['as'=>'company_users/update','uses'=>'CompanyUserController@update'])->middleware('auth');
Route::post('company_users/destroy', ['as'=>'company_users/destroy','uses'=>'CompanyUserController@destroy'])->middleware('auth');

//Group Module
Route::get('/groups', ['as'=>'groups','uses'=>'GroupController@index'])->middleware('auth');
Route::get('group/create', ['as'=>'group/create','uses'=>'GroupController@create'])->middleware('auth');
Route::post('group/store', ['as'=>'group/store','uses'=>'GroupController@store'])->middleware('auth');
Route::get('group/edit/{group_id}', ['as'=>'group/edit','uses'=>'GroupController@edit'])->middleware('auth');
Route::post('group/update', ['as'=>'group/update','uses'=>'GroupController@update'])->middleware('auth');
Route::post('group/destroy', ['as'=>'group/destroy','uses'=>'GroupController@destroy'])->middleware('auth');

//Companies Module
Route::get('/companies', ['as'=>'companies','uses'=>'CompaniesController@index'])->middleware('auth');
Route::get('companies/create', ['as'=>'companies/create','uses'=>'CompaniesController@create'])->middleware('auth');
Route::post('companies/store', ['as'=>'companies/store','uses'=>'CompaniesController@store'])->middleware('auth');
Route::post('companies/destroy', ['as'=>'companies/destroy','uses'=>'CompaniesController@destroy'])->middleware('auth');
Route::get('companies/edit/{user_id}', ['as'=>'companies/edit','uses'=>'CompaniesController@edit'])->middleware('auth');
Route::post('companies/update', ['as'=>'companies/update','uses'=>'CompaniesController@update'])->middleware('auth');

//Contact Module
Route::get('/contact', ['as'=>'contact','uses'=>'ContactController@index'])->middleware('auth');
Route::get('contact/create', ['as'=>'contact/create','uses'=>'ContactController@create'])->middleware('auth');
Route::post('contact/store', ['as'=>'contact/store','uses'=>'ContactController@store'])->middleware('auth');
Route::get('contact/edit/{contact_id}', ['as'=>'contact/edit','uses'=>'ContactController@edit'])->middleware('auth');
Route::post('contact/update', ['as'=>'contact/update','uses'=>'ContactController@update'])->middleware('auth');
Route::post('contact/destroy', ['as'=>'contact/destroy','uses'=>'ContactController@destroy'])->middleware('auth');
Route::get('contact/ajax_load_company_users', ['as'=>'contact/ajax_load_company_users','uses'=>'ContactController@ajax_load_company_users'])->middleware('auth');
Route::get('contact/ajax_load_stage_status', ['as'=>'contact/ajax_load_stage_status','uses'=>'ContactController@ajax_load_stage_status'])->middleware('auth');
Route::get('contact/ajax_load_update_status', ['as'=>'contact/ajax_load_update_status','uses'=>'ContactController@ajax_load_update_status'])->middleware('auth');
Route::post('contact/update_status', ['as'=>'contact/update_status','uses'=>'ContactController@update_status'])->middleware('auth');

//Contact Datasource Module
Route::get('/contact_datasource', ['as'=>'contact_datasource','uses'=>'ContactDatasourceController@index'])->middleware('auth');
Route::post('contact_datasource/store', ['as'=>'contact_datasource/store','uses'=>'ContactDatasourceController@store'])->middleware('auth');
Route::get('contact_datasource/ajax_load_stage_status', ['as'=>'contact_datasource/ajax_load_stage_status','uses'=>'ContactDatasourceController@ajax_load_stage_status'])->middleware('auth');
Route::get('contact_datasource/edit/{id}', ['as'=>'contact_datasource/edit','uses'=>'ContactDatasourceController@edit'])->middleware('auth');
Route::post('contact_datasource/update', ['as'=>'contact_datasource/update','uses'=>'ContactDatasourceController@update'])->middleware('auth');

//Contact Campaigns
Route::get('/contact_campaign', ['as'=>'contact_campaign','uses'=>'ContactCampaignController@index'])->middleware('auth');
Route::post('contact_campaign/store', ['as'=>'contact_campaign/store','uses'=>'ContactCampaignController@store'])->middleware('auth');
Route::post('contact_campaign/destroy', ['as'=>'contact_campaign/destroy','uses'=>'ContactCampaignController@destroy'])->middleware('auth');
Route::get('contact_campaign/ajax_load_edit_fields', ['as'=>'contact_campaign/ajax_load_edit_fields','uses'=>'ContactCampaignController@ajax_load_edit_fields'])->middleware('auth');
Route::post('contact_campaign/update', ['as'=>'contact_campaign/update','uses'=>'ContactCampaignController@update'])->middleware('auth');

//Contact Dashboard
Route::get('/contact_dashboard/{id}', ['as'=>'contact_dashboard','uses'=>'ContactDashboardController@index'])->middleware('auth');

//Contact Event
Route::post('contact_event/store', ['as'=>'contact_event/store','uses'=>'ContactEventController@store'])->middleware('auth');
Route::post('contact_event/destroy', ['as'=>'contact_event/destroy','uses'=>'ContactEventController@destroy'])->middleware('auth');
Route::post('contact_event/update', ['as'=>'contact_event/update','uses'=>'ContactEventController@update'])->middleware('auth');

//Workflow Categories
Route::get('/workflow_category', ['as'=>'workflow_category','uses'=>'WorkflowCategoryController@index'])->middleware('auth');
Route::get('/workflow_category/create', ['as'=>'workflow_category/create','uses'=>'WorkflowCategoryController@create'])->middleware('auth');
Route::post('workflow_category/store', ['as'=>'workflow_category/store','uses'=>'WorkflowCategoryController@store'])->middleware('auth');
Route::get('workflow_category/edit/{workflow_category_id}', ['as'=>'workflow_category/edit','uses'=>'WorkflowCategoryController@edit'])->middleware('auth');
Route::post('workflow_category/update', ['as'=>'workflow_category/update','uses'=>'WorkflowCategoryController@update'])->middleware('auth');
Route::post('workflow_category/destroy', ['as'=>'workflow_category/destroy','uses'=>'WorkflowCategoryController@destroy'])->middleware('auth');

//Stage
Route::get('/stage', ['as'=>'stage','uses'=>'StageController@index'])->middleware('auth');
Route::get('/stage/create', ['as'=>'stage/create','uses'=>'StageController@create'])->middleware('auth');
Route::post('stage/store', ['as'=>'stage/store','uses'=>'StageController@store'])->middleware('auth');
Route::get('stage/edit/{stage_id}', ['as'=>'stage/edit','uses'=>'StageController@edit'])->middleware('auth');
Route::post('stage/update', ['as'=>'stage/update','uses'=>'StageController@update'])->middleware('auth');
Route::post('stage/destroy', ['as'=>'stage/destroy','uses'=>'StageController@destroy'])->middleware('auth');
//Workflow
Route::get('/workflow', ['as'=>'workflow','uses'=>'WorkflowController@index'])->middleware('auth');
Route::get('/workflow/create', ['as'=>'workflow/create','uses'=>'WorkflowController@create'])->middleware('auth');
Route::post('workflow/store', ['as'=>'workflow/store','uses'=>'WorkflowController@store'])->middleware('auth');
Route::get('workflow/edit/{stage_id}', ['as'=>'workflow/edit','uses'=>'WorkflowController@edit'])->middleware('auth');
Route::post('workflow/update', ['as'=>'workflow/update','uses'=>'WorkflowController@update'])->middleware('auth');
Route::post('workflow/destroy', ['as'=>'workflow/destroy','uses'=>'WorkflowController@destroy'])->middleware('auth');
Route::get('workflow/ajax_load_stage_status', ['as'=>'workflow/ajax_load_stage_status','uses'=>'WorkflowController@ajax_load_stage_status'])->middleware('auth');

//Media Types
Route::get('/media_type', ['as'=>'media_type','uses'=>'MediaTypeController@index'])->middleware('auth');
Route::get('/media_type/create', ['as'=>'media_type/create','uses'=>'MediaTypeController@create'])->middleware('auth');
Route::post('media_type/store', ['as'=>'media_type/store','uses'=>'MediaTypeController@store'])->middleware('auth');
Route::get('media_type/edit/{workflow_category_id}', ['as'=>'media_type/edit','uses'=>'MediaTypeController@edit'])->middleware('auth');
Route::post('media_type/update', ['as'=>'media_type/update','uses'=>'MediaTypeController@update'])->middleware('auth');
Route::post('media_type/destroy', ['as'=>'media_type/destroy','uses'=>'MediaTypeController@destroy'])->middleware('auth');

//Event Types
Route::get('/event_type', ['as'=>'event_type','uses'=>'EventTypeController@index'])->middleware('auth');
Route::get('/event_type/create', ['as'=>'event_type/create','uses'=>'EventTypeController@create'])->middleware('auth');
Route::post('event_type/store', ['as'=>'event_type/store','uses'=>'EventTypeController@store'])->middleware('auth');
Route::get('event_type/edit/{workflow_category_id}', ['as'=>'event_type/edit','uses'=>'EventTypeController@edit'])->middleware('auth');
Route::post('event_type/update', ['as'=>'event_type/update','uses'=>'EventTypeController@update'])->middleware('auth');
Route::post('event_type/destroy', ['as'=>'event_type/destroy','uses'=>'EventTypeController@destroy'])->middleware('auth');

//Sources
Route::get('/source', ['as'=>'source','uses'=>'SourceController@index'])->middleware('auth');
Route::get('/source/create', ['as'=>'source/create','uses'=>'SourceController@create'])->middleware('auth');
Route::post('source/store', ['as'=>'source/store','uses'=>'SourceController@store'])->middleware('auth');
Route::get('source/edit/{workflow_category_id}', ['as'=>'source/edit','uses'=>'SourceController@edit'])->middleware('auth');
Route::post('source/update', ['as'=>'source/update','uses'=>'SourceController@update'])->middleware('auth');
Route::post('source/destroy', ['as'=>'source/destroy','uses'=>'SourceController@destroy'])->middleware('auth');

//Email Templates
Route::get('/email_template', ['as'=>'email_template','uses'=>'EmailTemplateController@index'])->middleware('auth');
Route::get('/email_template/create', ['as'=>'email_template/create','uses'=>'EmailTemplateController@create'])->middleware('auth');
Route::post('email_template/store', ['as'=>'email_template/store','uses'=>'EmailTemplateController@store'])->middleware('auth');
Route::get('email_template/edit/{email_template_id}', ['as'=>'email_template/edit','uses'=>'EmailTemplateController@edit'])->middleware('auth');
Route::post('email_template/update', ['as'=>'email_template/update','uses'=>'EmailTemplateController@update'])->middleware('auth');
Route::post('email_template/destroy', ['as'=>'email_template/destroy','uses'=>'EmailTemplateController@destroy'])->middleware('auth');
Route::get('email_template/ajax_load_email_template_content', ['as'=>'email_template/ajax_load_email_template_content','uses'=>'EmailTemplateController@ajax_load_email_template_content'])->middleware('auth');

//Mail Messaging
Route::get('/mail_messaging', ['as'=>'mail_messaging','uses'=>'MailMessagingController@index'])->middleware('auth');
Route::get('/mail_messaging/create', ['as'=>'mail_messaging/create','uses'=>'MailMessagingController@create'])->middleware('auth');
Route::post('mail_messaging/send', ['as'=>'mail_messaging/send','uses'=>'MailMessagingController@send'])->middleware('auth');
Route::get('mail_messaging/ajax_update_last_opened', ['as'=>'mail_messaging/ajax_update_last_opened','uses'=>'MailMessagingController@ajax_update_last_opened'])->middleware('auth');

//Benchmark
Route::get('benchmark/test_model', ['as'=>'benchmark/test_model','uses'=>'BenchmarkController@testModel'])->middleware('auth');
Route::get('benchmark/test_email', ['as'=>'benchmark/test_email','uses'=>'BenchmarkController@testMail'])->middleware('auth');
