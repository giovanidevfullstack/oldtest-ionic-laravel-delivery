angular.module('starter.controllers')
    .controller('LoginCtrl',[
        '$scope',
        'OAuth',
        '$state',
        '$ionicPopup',
        '$localStorage',function ($scope, OAuth, $state, $ionicPopup, $localStorage) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                OAuth.getAccessToken($scope.user)
                    .then(function (data) {
                        $localStorage.set('TOKEN',data.data.access_token);
                        $state.go('client.view_products');
                    },function (ResponseError) {
                        $ionicPopup.alert({
                            title:   'Alert',
                            template: 'Login e/ou senha inválidos'
                        });
                        console.log(ResponseError);
                    });
            }
        }]);