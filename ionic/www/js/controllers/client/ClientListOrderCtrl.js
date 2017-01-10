angular.module('starter.controllers')
    .controller('ClientListOrderCtrl',[
        '$scope',
        '$state',
        'OrderService', function ($scope, $state, OrderService) {

            $scope.orders = [];
            $scope.orders.itemQtd = '';

            OrderService.query({include:"items"},function (data) {
                $scope.orders = data.data;

                for (var i in $scope.orders){
                    var itemsOrder = $scope.orders[i].items;
                    var order = $scope.orders[i];

                    $scope.orders[i].itemQtd = itemsOrder.data.length;

                    switch (order.status) {
                        case 0:
                            $scope.orders[i].status = 'pendente';
                            break;
                        case 1:
                            $scope.orders[i].status = 'a caminho';
                            break;
                        case 2:
                            $scope.orders[i].status = 'entregue';
                            break;
                    }
                }
            },function (error) {
                console.log(error);
            });


            $scope.goViewProducts = function () {
                $state.go('client.view_products');
            };
        }
    ]);