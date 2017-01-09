angular.module('starter.services')
    .factory('UserService',['$resource','appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/authenticated',{},{
            query: {
                isArray: false
            },
            authenticated: {
                method: 'GET',
                url: appConfig.baseUrl + '/api/authenticated'
            }
        });
    }]);