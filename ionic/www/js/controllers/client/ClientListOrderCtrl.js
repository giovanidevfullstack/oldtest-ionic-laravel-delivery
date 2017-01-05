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
                    $scope.orders[i].itemQtd = itemsOrder.data.length;

                    switch (i) {
                        case '0':
                            $scope.orders[i].status = 'pendente';
                            break;
                        case '1':
                            $scope.orders[i].status = 'a caminho';
                            break;
                        case '2':
                            $scope.orders[i].status = 'entregue';
                            break;
                    }
                }
                console.log($scope.orders);
            },function (error) {});


            $scope.goHome = function () {
                $state.go('home');
            };
        }
    ]);


/*
$list_status = [
    0=>'pendente',
    1=>'a caminho',
    2=>'entregue'
];
*/