angular.module('starter.controllers')
    .controller('LoginCtrl',[
        '$scope',
        'OAuth',
        '$state',
        '$ionicPopup',
        'userAccessToken',function ($scope, OAuth, $state, $ionicPopup, userAccessToken) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                OAuth.getAccessToken($scope.user)
                    .then(function (data) {
                        userAccessToken = data.data.access_token;
                        console.log("TOKEN DO USER AUTH -> " + userAccessToken);
                        $state.go('home');
                    },function (ResponseError) {
                        $ionicPopup.alert({
                            title:   'Alert',
                            template: 'Login e/ou senha inválidos'
                        });
                    });
            }
        }]);