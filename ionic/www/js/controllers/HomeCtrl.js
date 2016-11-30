angular.module('starter.controllers')
    .controller('HomeCtrl',[
        '$scope',
        '$state',
        '$http',
        'userAccessToken', function ($scope, $state, $http, userAccessToken) {
            console.log("TOKEN    " + userAccessToken);

            var url = 'http://localhost:8000/api/authenticated/user';
            var bearer = "Bearer" + " " + userAccessToken;

            console.log("BEARER     " + bearer);
            $scope.userauth = {};

            $scope.getUserAuth = function () {
                console.log("retorna usuario autenticado");
                console.log("TOKEN  --  " + userAccessToken);

                $http.get(url, {
                    headers: {"Authorization": bearer}
                }).then(function (data) {
                       console.log(data);
                       $scope.userauth = data;
                  },function (Error) {
                       console.log('erro');
                  });
            };
        }
    ]);
