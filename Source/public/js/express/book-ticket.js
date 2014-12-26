(function() {
    var app = angular.module("book-ticket", []);

    app.controller("BookTicketController", function($scope) {
        var seats = [];

        $scope.back = function() {
            $("#result-operator").empty();
            $("#result-date").empty();
            $("#result-from").empty();
            $("#result-to").empty();
            $("#result-price").empty();

            seats = [];

            $("#step-2").fadeOut();
            $("#step-1").fadeIn();
        };

        $(".book-seat td").click(function() {
            var seat = $(this).context;

            if (seat.className == "seat-available") {
                $(seat).removeClass();
                $(seat).addClass("seat-checked");
                seats.push(seat.innerHTML);
            } else if (seat.className == "seat-checked") {
                $(seat).removeClass();
                $(seat).addClass("seat-available");
                seats.splice(seats.indexOf(seat.innerHTML), 1);
            }

            console.log(seats);
        })
    })
})();