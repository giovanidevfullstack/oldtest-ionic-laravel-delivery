angular.module('starter.controllers',[]);
angular.module('starter.services',[]);
angular.module('starter.filters',[]);
angular.module('starter', ['ionic','ionic.service.core','starter.controllers','starter.services', 'starter.filters',
                           'angular-oauth2','ngResource','ngCordova','uiGmapgoogle-maps','pusher-angular'])

.constant('appConfig',{
    baseUrl: 'http://192.168.0.4:8000',
    pusherKey: 'a0458ee1e52bb80fcf40'
})

.run(function($ionicPlatform, $window, appConfig, $localStorage) {
  //pusher init
  $window.client = new Pusher(appConfig.pusherKey);

  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }
    Ionic.io();
    var push = new Ionic.Push({
        debug: true,
        onNotification: function (message) {
            console.log(message);
            alert(message.text);
        },
        pluginConfig: {
            android: {
                iconColor: "blue"
            }
        }
    });
    push.register(function (token) {
        $localStorage.set('device_token', token.token);
    });
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
            cache: false,
            url: '/client',
            templateUrl: 'templates/client/menu.html',
            controller: 'ClientMenuCtrl'
        })
        .state('client.view_products',{
            cache: false,
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
            url: '/list_order',
            templateUrl: 'templates/client/list_order.html',
            controller: 'ClientListOrderCtrl'
        })
        .state('client.view_order',{
            url: '/view_order/:id',
            templateUrl: 'templates/client/view_order.html',
            controller: 'ClientViewOrderCtrl'
        })
        .state('client.view_delivery',{
            cache: false,
            url: '/view_delivery/:id',
            templateUrl: 'templates/client/view_delivery.html',
            controller: 'ClientViewDeliveryCtrl'
        })
        .state('deliveryman',{
            abstract: true,
            cache: false,
            url: '/deliveryman',
            templateUrl: 'templates/deliveryman/menu.html',
            controller: 'DeliverymanMenuCtrl'
        })
        .state('deliveryman.order',{
            url: '/order',
            templateUrl: 'templates/deliveryman/order.html',
            controller: 'DeliverymanOrderCtrl'
        })
        .state('deliveryman.view_order',{
            cache: false,
            url: '/view_order/:id',
            templateUrl: 'templates/deliveryman/view_order.html',
            controller: 'DeliverymanViewOrderCtrl'
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