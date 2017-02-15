angular.module('starter.controllers')
    .controller('ClientListOrderCtrl',[
        '$scope', '$state', 'ClientOrderService', '$ionicLoading','$ionicActionSheet',
        function ($scope, $state, ClientOrderService, $ionicLoading, $ionicActionSheet) {
            $scope.items = [];

            $ionicLoading.show({
                template: 'Carregando...'
            });

            $scope.doRefresh = function () {
                getOrders().then(function (data) {
                    $scope.items = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                },function () {
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.openOrderDetail = function (o) {
                $state.go('client.view_order',{id: o.id});
            };
            
            $scope.showActionSheet = function (order) {
                $ionicActionSheet.show({
                    buttons: [
                        {text: 'Ver detalhes'},
                        {text: 'Ver entrega'}
                    ],
                    titleText: 'Opções',
                    cancelText: 'Cancelar',
                    cancel: function () {
                        //
                    },
                    buttonClicked: function (index) {
                        switch (index){
                            case 0:
                                $state.go('client.view_order',{id: order.id});
                                break;
                            case 1:
                                $state.go('client.view_delivery',{id: order.id});
                                break;
                        }
                    }
                });
            };
            
            function getOrders() {
                return ClientOrderService.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            };

            getOrders().then(function (data) {
                $scope.items = data.data;
                $ionicLoading.hide();
            },function (error) {
                $ionicLoading.hide();
            });
        }
    ]);