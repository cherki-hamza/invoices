<?php

/*
*   Author  : cherki hamza
*   Website : hamzacherki.com
*   this is the routes of app
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth' ]
    ], function(){

    Route::prefix('dashboard')->middleware(['auth'])->group(function(){

      
        
        // route for the dashboard admin
        Route::get('/', 'backend\AdminController@index')->name('dashboard');
        // route for the sections crud  
        Route::resource('/sections', 'backend\SectionsController');
        // route for the products crud  
        Route::resource('/products', 'backend\ProductsCotroller');
        // route for the invoice crud 
        Route::resource('/invoices', 'backend\InvoicesController');
         // route for print invoice
         Route::get('/print_invoice/{id}', 'backend\InvoicesController@print_invoice')->name('print_invoice');
        // route for get the invoices products by section by ajax request
        Route::get('/invoice/{id}', 'backend\InvoicesController@getProducts')->name('invoice.get_products');
        // archive invoices
        Route::resource('/invoices_archive', 'backend\InvoicesArchiveController');
        

        Route::get('/invoices_paid', 'backend\InvoicesController@invoices_paid')->name('invoices_paid');
        Route::get('/invoices_unpaid', 'backend\InvoicesController@invoices_unpaid')->name('invoices_unpaid');
        Route::get('/invoices_partial', 'backend\InvoicesController@invoices_partial')->name('invoices_partial');

        // route for show the status form and update
        Route::get('/status_show/{id}', 'backend\InvoicesController@status_show')->name('status_show');
        // route for update status of invoice from unpaid to payed
        Route::post('/invoice_status_update/{id}', 'backend\InvoicesController@status_update')->name('invoice_status_update');

        

        // route for delete invoice file details
        Route::post('/delete_file', 'backend\InvoiceDetailsController@destroy')->name('delete_file');

        // custom_destroy
        Route::post('/custom_destroy', 'backend\InvoiceDetailsController@custom_destroy')->name('custom_destroy');

        // show the invoice section details from invoice table 
        Route::get('/invoice_details/{id}', 'backend\InvoiceDetailsController@edit')->name('invoice_details');

        // route four show the files 
        Route::get('/show_file/{invoice_number}/{file_name}', 'backend\InvoiceDetailsController@open_file')->name('open_file');

        // route for get the page of ex dashboard 
        Route::get('/{page}', 'backend\AdminController@pages');

        // InvoiceAttachementsController controller  InvoiceAttachementsController
        Route::resource('/invoice_attachements', 'backend\InvoiceAttachementsController');


   });

});











