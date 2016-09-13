<?php

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix'=>'admin',
              'as'=>'admin.',
              'middleware'=>'auth.checkrole'], function (){

    //categories crud
    Route::group(['prefix'=>'categories',
                  'as'=>'categories.'], function (){
        Route::get('',['as'=>'index',
            'uses'=>'CategoriesController@index']);
        Route::get('create',['as'=>'create',
            'uses'=>'CategoriesController@create']);
        Route::get('edit/{id}',['as'=>'edit',
            'uses'=>'CategoriesController@edit']);
        Route::post('update/{id}',['as'=>'update',
            'uses'=>'CategoriesController@update']);
        Route::post('store',['as'=>'store',
            'uses'=>'CategoriesController@store']);
    });

    //products crud
    Route::group(['prefix'=>'products',
                  'as'=>'products.'], function (){
        Route::get('',['as'=>'index',
            'uses'=>'ProductsController@index']);
        Route::get('create',['as'=>'create',
            'uses'=>'ProductsController@create']);
        Route::get('edit/{id}',['as'=>'edit',
            'uses'=>'ProductsController@edit']);
        Route::post('update/{id}',['as'=>'update',
            'uses'=>'ProductsController@update']);
        Route::post('store',['as'=>'store',
            'uses'=>'ProductsController@store']);
        Route::get('destroy/{id}',['as'=>'destroy',
            'uses'=>'ProductsController@destroy']);
    });
});
