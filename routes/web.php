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

Auth::routes(['verify' => true]);
Route::get('/', 'Auth\LoginController@landing')->name('landing');
Route::match(['get', 'post'], '/login', 'Auth\LoginController@login')->name('login');
Route::match(['get', 'post'], '/register', 'Auth\LoginController@register')->name('register');
Route::post('/check-exists', 'Auth\LoginController@exists_record')->name('check.exists');

/*Paypal payment routes*/
Route::match(['get', 'post'], '/stripe-subscription-callbacks', 'StripePayment@webhook');
Route::match(['get', 'post'], '/subscription', 'StripePayment@createSubscription')->name('subscription');
Route::get('/pricing', 'StripePayment@pricing')->name('pricing');

Route::prefix('stripe')->group(function () {
    Route::match(['get', 'post'], 'create-recuring-progile', 'StripePayment@paypalSuccess')->name('stripe_subscription_success')->middleware(['guest']);
    Route::match(['get', 'post'], 'ipn-notify', 'StripePayment@postNotify');
    Route::middleware(["auth:web"])->post('update-subscription', 'StripePayment@changeSubscription')->name('paypal_update_subscription');
    Route::middleware(["auth:web"])->match(['get', 'post'], 'update-success-subscription', 'StripePayment@paypalUpdateSuccess')->name('stripe_update_success');
    Route::middleware(["auth:web"])->post('cancel-subscription', 'StripePayment@cancelSubscription')->name('cancel-subscription');
});

/* User Routes*/
Route::get('logout', 'HomeController@logout')->name('logout');
Route::group(['middleware' => ['auth', 'verified', 'check.subscription','check.userstatus']], function () {


    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', 'HomeController@index')->name('dashboard');
    Route::post('load-legiit-services/{last_search_type}', 'HomeController@loadLegiitServices')->name('loadLegiitServices');
    Route::get('email-templates', 'HomeController@emailTemplates')->name('email.template');
    Route::get('view-email-templates', 'HomeController@previewEmailTemplates')->name('view.emailtemplates');
    Route::delete('email-templates/{id}/delete', 'HomeController@deleteEmailTemplate')->name('delete.emailtemplate');
    Route::match(['get','post'],'email-templates/{id}/duplicate', 'HomeController@duplicateEmailTemplate')->name('duplicate.emailtemplate');
    Route::get('past-search-filter', 'HomeController@filterPastSearch')->name('filterPastSearch');
    Route::get('check-password', 'HomeController@passwordCheck')->name('check.current_password');

    /* Campaigns Master Routes*/
    Route::match(['get','post'],'new-search', 'CampaignMasterController@new_search')->name('new_search');
    Route::match(['get','post'],'search-history', 'CampaignMasterController@search_history')->name('search_history');
    Route::get('search-result/{id}', 'CampaignMasterController@showSearchResult')->name('search_result');
    Route::get('training', 'CampaignMasterController@training')->name('training');
    Route::get('export-search-history/{id}', 'CampaignMasterController@exportSearchResults')->name('exportSearchResults');
    Route::get('load-email-template', 'CampaignMasterController@loadEmailTemplate')->name('loadEmailTemplate');
    Route::get('search-history/print/{id}', 'CampaignMasterController@printSeachResult')->name('printSeachResult');
    Route::post('send-email', 'CampaignMasterController@sendEmail')->name('campaign.sendemail');
    Route::delete('search-history/{id}/delete', 'CampaignMasterController@campaignDestroy')->name('campaignDestroy');

    /* Profile Settting Routes*/
    Route::match(['get', 'post'], 'settings', 'CampaignMasterController@settings')->name('settings');
});


/***************************************Admin routes**********************************************/
/*Admin Route*/
Route::match(['get', 'post'], 'admin', 'Auth\LoginController@AdminLogin')->name('admin.login');
Route::middleware(['auth:admin'])->prefix('admin')->namespace('Backend')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('logout', 'DashboardController@logout')->name('admin.logout');
    Route::post('dashboard', 'DashboardController@change_password')->name('admin.change_password');
    Route::post('check-password', 'DashboardController@check_password')->name('admin.check_password');

    /*Users routes*/
    Route::resource('user', 'UserController');
    Route::post('user/change-status/{id}/{status}', 'UserController@changeStatus')->name('user.changesStatus');
    Route::get('payment-history', 'UserController@paymentHistory')->name('user.paymentHistory');

    /*Subscription routes*/
    Route::resource('subscription', 'SubscriptionController');
    Route::post('subscription/change-status/{id}/{status}', 'SubscriptionController@changeStatus')->name('subscription.changesStatus');

    /*Search Type routes*/
    Route::get('search-types', 'SearchTypeController@index')->name('searchtype.index');
    Route::post('search-types/change-status/{id}/{status}', 'SearchTypeController@changeStatus')->name('searchtype.changeStatus');
    Route::match(['get','post'],'search-types/{id}/update', 'SearchTypeController@update')->name('searchtype.update');
    Route::delete('search-types/{id}/delete', 'SearchTypeController@destroy')->name('searchtype.delete');

    /*Compaigns Master Routes*/
    Route::get('search-history/{id}', 'CampaignsMasterController@index')->name('campaigns.index');
    Route::get('search-result-history/{id}/view', 'CampaignsMasterController@show')->name('campaigns.show');
    Route::delete('search-result-history/{id}/delete', 'CampaignsMasterController@destroy')->name('campaigns.delete');
    Route::delete('search-result-history/result/{id}/delete', 'CampaignsMasterController@deleteCampaignResult')->name('campaigns_result.delete');

    /*Settings Routes*/
    Route::prefix('settings')->group(function () {
        /*Email Template Routes*/
        Route::get('email-templates', 'SettingController@emailTemplates')->name('emailtemplate');
        Route::match(['get', 'post'], 'email-template/add', 'SettingController@addEmailTemplate')->name('addEmailtemplate');
        Route::match(['get', 'post'], 'email-template/edit/{id}', 'SettingController@editEmailTemplate')->name('editemailtemplate');
        Route::get('email-template/preview', 'SettingController@previewEmailTemplates')->name('preview-template');
        Route::delete('email-template/{id}/delete', 'SettingController@deleteEmailTEmplate')->name('deleteEmailTemplate');

        /*Member Content CMS Routes*/
        Route::get('member-content-cms', 'SettingController@memberContent')->name('member_content');
        Route::match(['get', 'post'], 'member-content-cms/add', 'SettingController@addMemberContent')->name('addMemberContent');
        Route::post('member-content-cms/status-change/{id}/{status}', 'SettingController@memberContentStatusChange')->name('memberContentStatusChange');
        Route::match(['get', 'post'], 'member-content-cms/edit/{id}', 'SettingController@editMemberContent')->name('editMemberContent');
        Route::delete('member-content-cms/{id}/delete', 'SettingController@destroyMemberContent')->name('membercontent.delete');
    });
});
