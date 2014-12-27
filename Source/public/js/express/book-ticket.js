(function() {
    var app = angular.module("book-ticket", []);

    app.controller("BookTicketController", function($scope) {
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
                $("#list-seats").tagsinput("add", seat.innerHTML);
            } else if (seat.className == "seat-checked") {
                $(seat).removeClass();
                $(seat).addClass("seat-available");
                $("#list-seats").tagsinput("remove", seat.innerHTML);
            }
        });

        $("#list-seats")
            .on("beforeItemRemove", function(event) {
                $("#seat-" + event.item)
                    .removeClass()
                    .addClass("seat-available");
            })
            .on("beforeItemAdd", function(event) {
                if ($("#seat-" + event.item)[0].className == "seat-booked") {
                    event.cancel = true;
                } else {
                    $("#seat-" + event.item)
                        .removeClass()
                        .addClass("seat-checked");
                }
            }
        );
    })
})();