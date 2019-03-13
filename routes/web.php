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

Auth::routes(['verify' => true]);
Route::get('lang/{lang}', 'LanguageController@switchLang')->name('lang.switch');
Route::get('/sitemap', 'SiteMapController@sitemap');


/*     Verified     */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index')->middleware('verified');
Route::get('/dashboard/edit', 'DashboardController@edit')->name('dashboard.edit')->middleware('verified');
Route::post('/dashboard', 'DashboardController@store')->name('dashboard.store')->middleware('verified');
Route::post('/dashboard/upload', 'DashboardController@upload')->name('dashboard.upload')->middleware(['verified', 'optimizeImages']);
Route::get('/dashboard/deleteImage', 'DashboardController@deleteImage')->name('dashboard.deleteImage')->middleware('verified');
Route::get('/dashboard/activate', 'DashboardController@activate')->name('dashboard.activate')->middleware('verified');
Route::get('/dashboard/deactivate', 'DashboardController@deactivate')->name('dashboard.deactivate')->middleware('verified');
Route::get('/dashboard/identify', 'DashboardController@identify')->name('dashboard.identify')->middleware('verified');
Route::post('/dashboard/uploadIdentity', 'DashboardController@uploadIdentity')->name('dashboard.uploadIdentity')->middleware('verified');
Route::get('/dashboard/deleteIdentity', 'DashboardController@deleteIdentity')->name('dashboard.deleteIdentity')->middleware('verified');

Route::get('/identity/{filename}', 'IdentityController@index')->name('identity.index')->middleware('verified');

Route::get('/matches', 'MatchController@index')->name('match.index')->middleware(['verified', 'profiled']);
Route::get('/matches/{name}', 'MatchController@show')->name('match.show')->middleware(['verified', 'profiled']);
Route::post('/matches/request', 'MatchController@request')->name('match.request')->middleware(['verified', 'profiled']);


/*     Public     */
Route::get('/event', function() {
    return redirect(config('app.fallback_locale').'/event', 301);
});
Route::get('/{locale}/event', function($locale = null) {
    return view('event');
})->name('event.index')->middleware('locale');

Route::get('/terms', function() {
    return redirect(config('app.fallback_locale').'/terms', 301);
});
Route::get('/{locale}/terms', 'StaticController@terms')->name('static.terms')->middleware('locale');

Route::get('/disclaimer', function() {
    return redirect(config('app.fallback_locale').'/disclaimer', 301);
});
Route::get('/{locale}/disclaimer', 'StaticController@disclaimer')->name('static.disclaimer')->middleware('locale');

Route::get('/privacy', function() {
    return redirect(config('app.fallback_locale').'/privacy', 301);
});
Route::get('/{locale}/privacy', 'StaticController@privacy')->name('static.privacy')->middleware('locale');

Route::get('/faq', function() {
    return redirect(config('app.fallback_locale').'/faq', 301);
});
Route::get('/{locale}/faq', 'StaticController@faq')->name('static.faq')->middleware('locale');

Route::get('/aboutus', function() {
    return redirect(config('app.fallback_locale').'/aboutus', 301);
});
Route::get('/{locale}/aboutus', 'StaticController@aboutus')->name('static.aboutus')->middleware('locale');

Route::get('/inquiry', function() {
    return redirect(config('app.fallback_locale').'/inquiry', 301);
});
Route::get('/{locale}/inquiry', 'InquiryController@index')->name('inquiry.index')->middleware('locale');
Route::post('/{locale}/inquiry', 'InquiryController@store')->name('inquiry.store')->middleware('locale');

/*     THIS MUST BE LAST     */
Route::get('/', function() {
    return redirect('/'.config('app.fallback_locale'), 301);
});
Route::get('/{locale}', 'Welcome')->name('welcome')->middleware('locale');
