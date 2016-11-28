angular.module('starter.controllers')
.controller('ClientViewProductsCtrl',[
    '$scope',
    '$state',
    'appConfig',
    '$resource', function ($scope, $state, appConfig,$resource) {
        var products = $resource(appConfig.baseUrl + '/api/client/products',{},{
            query: {
                isArray: false
            }
        });

        products.query({},function (data) {
            console.log(data.data);
        });
    }
]);

