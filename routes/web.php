<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', function () { return redirect('admin/beranda'); });
Route::get('home', function () { return redirect('admin/beranda'); })->name('home');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin','middleware' => 'auth'], function () {
    Route::get('/', function () { return redirect('admin/beranda'); });
    Route::get('beranda', 'HomeController@index')->name('index');

    // Helper Route Untuk get value select Form
    Route::get('getSelectSupplier', 'HelperController@getSelectSupplier')->name('getSelectSupplier');
    Route::get('getSelectGudang', 'HelperController@getSelectGudang')->name('getSelectGudang');
    Route::get('getSelectBarang', 'HelperController@getSelectBarang')->name('getSelectBarang');

    // Master route
    Route::group(['prefix' => 'master', 'namespace' => 'Master', 'as' => 'master.','middleware' => ['permission:1,2']], function () {
        // Master Gudang
        Route::group(['prefix' => 'gudang', 'as' => 'gudang.','middleware' => ['permission:1']], function () {
            Route::get('/', 'GudangController@index')->name('index');
            Route::post('detail', 'GudangController@detail')->name('detail');
            Route::post('store', 'GudangController@store')->name('store');
            Route::post('scopeData', 'GudangController@scopeData')->name('scopeData');
            Route::post('destroy', 'GudangController@destroy')->name('destroy');
        });
        // Master Supplier
        Route::group(['prefix' => 'supplier', 'as' => 'supplier.','middleware' => ['permission:1']], function () {
            Route::get('/', 'SupplierController@index')->name('index');
            Route::post('detail', 'SupplierController@detail')->name('detail');
            Route::post('store', 'SupplierController@store')->name('store');
            Route::post('scopeData', 'SupplierController@scopeData')->name('scopeData');
            Route::post('destroy', 'SupplierController@destroy')->name('destroy');
        });
        // Master Barang
        Route::group(['prefix' => 'barang', 'as' => 'barang.','middleware' => ['permission:1']], function () {
            Route::get('/', 'BarangController@index')->name('index');
            Route::post('detail', 'BarangController@detail')->name('detail');
            Route::post('store', 'BarangController@store')->name('store');
            Route::post('scopeData', 'BarangController@scopeData')->name('scopeData');
            Route::post('destroy', 'BarangController@destroy')->name('destroy');
        });
    });
});
