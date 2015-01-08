function removeTicket(element) {
    $($(element).parents()[1]).fadeOut();
}

(function() {
    var app = angular.module("payment", []);

    app.controller("paymentController", function($scope) {
        $scope.pay = function() {
            console.log("Pay");
        }
    });
})();