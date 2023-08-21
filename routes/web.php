<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\RevenueTypeController;
use App\Http\Controllers\CommunityTaxController;
use App\Http\Controllers\RealPropertyController;
use App\Http\Controllers\AccountableFormController;
use App\Http\Controllers\CollectionReportController;
use App\Http\Controllers\AccountableFormItemController;
use App\Http\Controllers\AccountableFormTypeController;

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



/*
index - show all 
show - show one 
create - show form to create  new 
store - store new 
edit - show form to edit one 
update - save new data of edited 
destroy - delete one 
*/

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('show-users');
    Route::get('edit-user/{user}', 'edit')->name('edit-user');
    Route::put('edit-user/{user}', 'update');
});


Route::controller(MessageController::class)->group(function () {
    Route::post('/save-message', 'store')->name('save-message');
    Route::get('/messages', 'index')->name('messages');
}); 

Route::controller(CollectionReportController::class)->group(function () {
    Route::get('/draft-collection-report', 'draft')->name('draft-individual-report');
    
});

Route::controller(AssignmentController::class)->group(function () {
    Route::get('/assignment/{user}', 'edit')->name('edit-assignment');
    Route::put('/assignment/{user}', 'update');
});

Route::controller(CommentController::class)->group(function () {
    Route::post('/comment/{accountableForm}', 'store')->name('submit-comment');
});

Route::controller(CollectorController::class)->group(function () {
    Route::get('/collectors', 'index')->name('collectors-home');
    Route::get('/supervised-collectors', 'supervised')->name('supervised-collectors');
});

Route::controller(CommunityTaxController::class)->group(function () {
    Route::get('/register-community-tax-individual/{accountableForm}', 'createIndividual')->name('record-community-tax-individual');
    Route::POST('/register-community-tax-individual/{accountableForm}', 'storeIndividual');
    Route::get('/register-community-tax-corporate/{accountableForm}', 'createCorporate')->name('record-community-tax-corporate');
    Route::POST('/register-community-tax-corporate', 'storeCorporate');
});

Route::controller(RevenueTypeController::class)->group(function () {
    Route::get('/revenue-type-index', 'index')->name('revenue-type-index');
    Route::get('/create-revenue-type', 'create')->name('create-revenue-type');
    Route::POST('/create-revenue-type', 'store');
    // Route::get('/register-community-tax-corporate/{accountableForm}', 'createCorporate')->name('record-community-tax-corporate');
    // Route::POST('/register-community-tax-corporate', 'storeCorporate');
});

Route::controller(RealPropertyController::class)->group(function () {
    Route::get('/register-real-property-tax-receipt/{accountableForm}', 'create')->name('record-real-property-tax-receipt');
    Route::POST('/register-real-property-tax-receipt', 'store');
});

Route::controller(AccountableFormController::class)->group(function () {
    Route::get('/portalHome', 'index')->name('userhome');
    // Route::get('/dashboard2', 'dashboard');
    Route::get('/my-draft-report', 'userDraft')->name('view-own-draft-individual-report');
    Route::get('/review-accountable-form/{accountableForm}', 'review')->name('review-accountable-form');
    Route::get('/show-accountable-form/{accountableForm}', 'show')->name('show-accountable-form');
    Route::get('/register-accountable-form', 'create')->name('create-accountable-form');
    Route::post('/register-accountable-form', 'store');
    Route::get('record/{accountableFormType}', 'record')->name('record-accountable-form');
    Route::put('record/{accountableFormType}', 'fill');
    Route::get('edit/{accountableForm}', 'record')->name('edit-accountable-form');
    Route::put('edit/{accountableForm}', 'update');
    Route::delete('/{accountableForm}', 'destroy')->name('delete-accountable-form');
});


Route::controller(AccountableFormItemController::class)->group(function () {
    Route::get('/accountableFormItem/{accountableForm}', 'index')->name('add-accountable-form-item');
    Route::post('/accountableFormItem/{accountableForm}', 'store');
    Route::delete('/accountableFormItem/{accountableFormItem}', 'destroy')->name('delete-accountable-form-item');
});

Route::controller(AccountableFormTypeController::class)->group(function () {
    Route::get('/accountableFormType', 'index')->name('accountable-form-type-index');
    Route::get('/accountableFormType/create', 'create')->name('create-accountable-form-type');
    Route::post('/accountableFormType/create', 'store');
    Route::get('edit/{accountableFormType}', 'edit')->name('edit-accountable-form-type');
    Route::put('edit/{accountableFormType}', 'update');
    Route::delete('/accountableFormType/{accountableFormType}', 'destroy')->name('delete-accountable-form-type');
});


Route::redirect('/', 'login');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::fallback(function() {
        return view('pages/utility/404');
    });    
});