angular.module('starter.controllers',[])
    .controller('HomeCtrl',[
        '$scope',
        '$state',
        '$http', function ($scope, $state, $http) {

            $scope.userauth = {};

            $scope.getUserAuth = function () {
                console.log("retorna usuario autenticado");
                $http.get('http://localhost:8000/api/authenticated/user', {
                    headers: {'Authorization': 'Bearer 6LKSpstSaCVbf5oXnqRsO6PTNmk4O9TnZIYiw9Vr'}
                }).then(function (data) {
                       console.log(data);
                       $scope.userauth = data;
                  },function (Error) {
                       console.log('erro');
                  });
            };
        }
    ]);
