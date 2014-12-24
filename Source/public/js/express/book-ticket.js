(function() {
    var app = angular.module("book-ticket", []);

    app.controller("BookTicketController", function($scope) {
        $scope.back = function() {
            $("#step-2").fadeOut();
            $("#step-1").fadeIn();
        }
    })
})();