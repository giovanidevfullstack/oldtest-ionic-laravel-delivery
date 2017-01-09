angular.module('starter.controllers',[]);
angular.module('starter.services',[]);
angular.module('starter', ['ionic','starter.controllers','starter.services','angular-oauth2','ngResource','ngCordova'])

.constant('appConfig',{
    baseUrl: 'http://192.168.0.2:8000' //localhost
})

.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
  });
})

.config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider, appConfig, $provide) {
    OAuthProvider.configure({
        baseUrl: appConfig.baseUrl,
        clientId: 'appid01',
        clientSecret: 'secret', //optional
        grantPath: '/oauth/access_token'
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false
        }
    });

    $stateProvider
        .state('login',{
            url: '/login',
            templateUrl: 'templates/login.html',
            controller: 'LoginCtrl'
        })
        .state('home',{
            url: '/home',
            templateUrl: 'templates/home.html',
            controller: 'HomeCtrl'
        })
        .state('client',{
            abstract: true,
            url: '/client',
            templateUrl: 'templates/client/menu.html',
            controller: 'ClientMenuCtrl'
        })
        .state('client.view_products',{
            url: '/view_products',
            templateUrl: 'templates/client/view_products.html',
            controller: 'ClientViewProductsCtrl'
        })
        .state('client.checkout',{
            cache: false,
            url: '/checkout',
            templateUrl: 'templates/client/checkout.html',
            controller: 'ClientCheckoutCtrl'
        })
        .state('client.checkout_successful',{
            url: '/checkout_successful',
            templateUrl: 'templates/client/checkout_successful.html',
            controller: 'ClientCheckoutSuccessful'
        })
        .state('client.checkout_item_detail',{
            url: '/checkout/detail/:index',
            templateUrl: 'templates/client/checkout_item_detail.html',
            controller: 'ClientCheckoutDetailCtrl'
        })
        .state('client.list_order',{
            url: '/list_order:id',
            templateUrl: 'templates/client/list_order.html',
            controller: 'ClientListOrderCtrl'
        });
    $urlRouterProvider.otherwise('/login');

    $provide.decorator('OAuthToken',['$localStorage','$delegate', function ($localStorage,$delegate) {
        Object.defineProperties($delegate,{
            setToken:{
                value: function (data) {
                    return $localStorage.setObject('token',data);
                },
                enumerable: true,
                configurable: true,
                writable: true
            },
            getToken:{
                value: function () {
                    return $localStorage.getObject('token');
                },
                enumerable: true,
                configurable: true,
                writable: true
            },
            removeToken:{
                value: function () {
                    $localStorage.setObject('token',null);
                },
                enumerable: true,
                configurable: true,
                writable: true
            }
        });
        return $delegate;
    }]);
});