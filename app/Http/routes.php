<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin',
              'as'=>'admin.',
              'middleware'=>'auth.checkrole:admin'], function (){

    //categories crud
    Route::group(['prefix'=>'categories',
                  'as'=>'categories.'], function (){
        Route::get('',['as'=>'index','uses'=>'CategoriesController@index']);
        Route::get('create',['as'=>'create','uses'=>'CategoriesController@create']);
        Route::get('edit/{id}',['as'=>'edit','uses'=>'CategoriesController@edit']);
        Route::post('update/{id}',['as'=>'update','uses'=>'CategoriesController@update']);
        Route::post('store',['as'=>'store','uses'=>'CategoriesController@store']);
    });

    //products crud
    Route::group(['prefix'=>'products',
                  'as'=>'products.'], function (){
        Route::get('',['as'=>'index','uses'=>'ProductsController@index']);
        Route::get('create',['as'=>'create','uses'=>'ProductsController@create']);
        Route::get('edit/{id}',['as'=>'edit','uses'=>'ProductsController@edit']);
        Route::post('update/{id}',['as'=>'update','uses'=>'ProductsController@update']);
        Route::post('store',['as'=>'store','uses'=>'ProductsController@store']);
        Route::get('destroy/{id}',['as'=>'destroy','uses'=>'ProductsController@destroy']);
    });

    //clients crud
    Route::group(['prefix'=>'clients',
                  'as'=>'clients.'], function (){
        Route::get('',['as'=>'index','uses'=>'ClientsController@index']);
        Route::get('create',['as'=>'create','uses'=>'ClientsController@create']);
        Route::get('edit/{id}',['as'=>'edit','uses'=>'ClientsController@edit']);
        Route::post('update/{id}',['as'=>'update','uses'=>'ClientsController@update']);
        Route::post('store',['as'=>'store','uses'=>'ClientsController@store']);
        Route::get('destroy/{id}',['as'=>'destroy','uses'=>'ClientsController@destroy']);
    });

    //pedidos
    Route::group(['prefix'=>'orders',
                  'as'=>'orders.'], function (){
        Route::get('',['as'=>'index','uses'=>'OrdersController@index']);
        Route::get('/{id}',['as'=>'edit','uses'=>'OrdersController@edit']);
        Route::post('update/{id}',['as'=>'update','uses'=>'OrdersController@update']);
    });

    //cupoms
    Route::group(['prefix'=>'cupoms',
        'as'=>'cupoms.'], function (){
        Route::get('',['as'=>'index','uses'=>'CupomsController@index']);
        Route::get('create',['as'=>'create','uses'=>'CupomsController@create']);
        Route::post('store}',['as'=>'store','uses'=>'CupomsController@store']);
    });
});


Route::group(['prefix'=>'custumer', 'middleware'=>'auth.checkrole:client', 'as'=>'custumer.'], function (){
    Route::get('order',['as'=>'order.index', 'uses'=>'CheckoutController@index']);
    Route::get('order/create',['as'=>'order.create', 'uses'=>'CheckoutController@create']);
    Route::post('order/store',['as'=>'order.store', 'uses'=>'CheckoutController@store']);
});

Route::group(['middleware'=>'cors'],function (){
    //OAuth2
    Route::post('oauth/access_token', function() {
        return Response::json(Authorizer::issueAccessToken());
    });

    //rotas protegidas da api com oauth2
    Route::group(['prefix'=>'api','middleware'=>'oauth', 'as'=>'api.'], function (){
        Route::group(['prefix'=>'client', 'middleware'=>'oauth.checkrole:client', 'as'=>'client.'], function (){
            Route::resource('order',
                'Api\Client\ClientCheckoutController',['except' => ['create', 'edit', 'destroy']]);
            Route::get('products','Api\Client\ClientProductController@index');
        });

        Route::group(['prefix'=>'deliveryman', 'middleware'=>'oauth.checkrole:deliveryman','as'=>'deliveryman.'], function (){
            Route::resource('order',
                'Api\Deliveryman\DeliverymanCheckoutController',['except' => ['create', 'edit', 'destroy','store']]);
            Route::patch('order/{id}/update-status', [
                'uses'=>'Api\Deliveryman\DeliverymanCheckoutController@updateStatus',
                'as'=>'orders.update_status']);
            Route::post('order/{id}/geo', [
                'as'=>'orders.geo', 'uses'=>'Api\Deliveryman\DeliverymanCheckoutController@geo'
            ]);
        });

        Route::group(['prefix'=>'authenticated', 'as'=>'authenticated.'], function (){
            Route::resource('user',
                'Api\Authenticated\AuthenticatedController',['except' => ['create', 'edit', 'destroy']]);
        });

        Route::get('cupom/{code}', 'Api\CupomController@show');
    });
});



