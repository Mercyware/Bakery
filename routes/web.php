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


Auth::routes();


Route::get('/', 'Auth\LoginController@showLoginForm'); //Reset Password


Route::get('/home', 'HomeController@index')->name('dashboard');


Route::prefix('suppliers')->group(function () {
    //Supplier Record Routes
    Route::get('/', 'SupplierController@allSuppliers')->name('suppliers');
    Route::get('/list', 'SupplierController@getAllSuppliersToDataTable')->name('suppliers.list');
    Route::get('/view/{supplier_id}', 'SupplierController@viewSupplier')->name('suppliers.view');
    Route::post('/store', 'SupplierController@createSupplier')->name('supplier.store');
    Route::get('/edit/{supplier_id}', 'SupplierController@editSupplier')->name('supplier.edit');
    Route::patch('/edit/{supplier_id}', 'SupplierController@updateSupplier')->name('supplier.update');

    //Supplier Payment/ Money Tranfer Routes
    Route::post('/pay/{supplier_id}', 'SupplierController@paySupplier')->name('supplier.pay');
    Route::post('/pay/multiple/suppliers', 'SupplierController@payMultipleSupplier')->name('supplier.pay.multiple');
    Route::post('/pay/multiple/transfer', 'SupplierController@payAllSuppliers')->name('supplier.pay.multiple.transfer');

    //Supplier Payment History
    Route::get('/payment/history/{supplier_id?}', 'SupplierController@supplierPaymentHistory')->name('suppliers.payment');
    Route::get('/payment/history/list/{supplier_id}', 'SupplierController@getAllSuppliersPaymentHistoryToDataTable')->name('suppliers.payment.list');


});

Route::prefix('supply')->group(function () {
    Route::post('/store', 'SupplyController@storeSupply')->name('supply.store');
    Route::get('/{supplier_id?}', 'SupplyController@allSupplies')->name('supplies');
    Route::get('/list/{supplier_id?}', 'SupplyController@getAllSuppliesToDataTable')->name('supplies.list');
    Route::get('/view/{supply_id}', 'SupplyController@viewSupplyDetails')->name('supplies.view');

});

Route::prefix('settings')->group(function () {

    Route::get('/account/balance', 'SettingController@accountBalance')->name('account.balance');


});
