angular.module('starter.controllers')
    .controller('ClientMenuCtrl',[
        '$scope','UserService','$ionicLoading', function ($scope, UserService, $ionicLoading) {
            $scope.user = {
                name: ''
            };

            $ionicLoading.show({
                template: 'Carregando...'
            });

            UserService.authenticated({},function (data) {
                $scope.user = data.data;
                $ionicLoading.hide();
            },function (Error) {
                console.log(Error);
            });
        }
    ]);

