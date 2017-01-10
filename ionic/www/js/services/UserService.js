angular.module('starter.services')
    .factory('UserService',['$resource','appConfig','$localStorage', function ($resource, appConfig, $localStorage) {
        return $resource(appConfig.baseUrl + '/api/authenticated/user',{},{
            query: {
                isArray: false
            },
            authenticated: {
                method: 'GET',
                url: appConfig.baseUrl + '/api/authenticated/user'
            }
        });
    }]);