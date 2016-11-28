angular.module('starter.controllers',[]);
angular.module('starter', ['ionic','starter.controllers','angular-oauth2','ngResource'])

.value('userAccessToken', '')

.constant('appConfig',{
    baseUrl: 'http://localhost:8000'
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

.config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider, appConfig) {
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
            template: '<ui-view/>'
        })
        .state('client.checkout',{
            url: '/checkout',
            templateUrl: 'templates/client/checkout.html',
            controller: 'ClientCheckoutCtrl'
        })
        .state('client.checkout_item_detail',{
            url: '/checkout/detail/:index',
            templateUrl: 'templates/client/checkout_item_detail.html',
            controller: 'ClientCheckoutDetailCtrl'
        })
        .state('client.view_products',{
            url: '/view_products',
            templateUrl: 'templates/client/view_products.html',
            controller: 'ClientViewProductsCtrl'
        });
    //$urlRouterProvider.otherwise('/');
});