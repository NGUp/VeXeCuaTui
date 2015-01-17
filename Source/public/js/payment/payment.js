angular.module("payment", ["header"])
    .controller("paymentController", function($scope) {
        $('.btn-function').click(function() {
            $scope.ticket_id = $($($(this).parents()[1]).find('.col-id')[0]).html().trim();
        });

        $scope.pay = function() {

        };

        $scope.remove = function() {

        };
    });