(function() {
    var app = angular.module("book-ticket", []);

    app.controller("BookTicketController", function($scope) {
        $scope.back = function() {
            $("#result-operator").empty();
            $("#result-date").empty();
            $("#result-from").empty();
            $("#result-to").empty();
            $("#result-price").empty();

            $("#step-2").fadeOut();
            $("#step-1").fadeIn();
        };

        $(".book-seat td").click(function() {
            var seat = $(this);
            console.log(seat);
        })
    })
})();