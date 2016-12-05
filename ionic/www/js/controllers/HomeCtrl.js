angular.module('starter.controllers')
    .controller('HomeCtrl',[
        '$scope',
        '$state',
        '$http',
        '$localStorage', function ($scope, $state, $http, $localStorage) {

            var token = $localStorage.get('TOKEN');
            var url = 'http://localhost:8000/api/authenticated/user';
            var bearer = "Bearer" + " " + token;

            $scope.userauth = {};

            $scope.getUserAuth = function () {
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
