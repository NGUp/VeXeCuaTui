(function() {
    var app = angular.module("book-ticket", []);

    app.controller("BookTicketController", function($scope) {
        $scope.back = function() {
            $("#result-operator").empty();
            $("#result-date").empty();
            $("#result-from").empty();
            $("#result-to").empty();
            $("#result-price").empty();

            $("#book-step-1").addClass("badge search-step-active");
            $("#book-step-2").removeClass("badge search-step-active");
            $("#book-step-3").removeClass("badge search-step-active");

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
                if ($("#seat-" + event.item)[0] == undefined || $("#seat-" + event.item)[0].className == "seat-booked") {
                    event.cancel = true;
                } else {
                    $("#seat-" + event.item)
                        .removeClass()
                        .addClass("seat-checked");
                }
            }
        );

        $scope.pay = function() {
            $.ajax({
                type: "POST",
                url: "/syn/booktickets",
                data: {
                    "customer" : $scope.customer,
                    "phone" : $scope.phone,
                    "email" : $scope.email,
                    "tickets" : $("#list-seats").val(),
                    "car" : $("#car-id").val()
                }
            }).done(function(message) {
                var pattern, reg_err, match, index;

                pattern = /\[(.*?)\]/igm;
                reg_err = new RegExp(pattern);

                if (reg_err.test(message)) {
                    while (match = pattern.exec(message)) {
                        index = pattern.lastIndex;
                    }
                    $('#error-content').html(message.substring(index, message.length).trim());
                    $('#error-modal').modal();
                } else {
                    $("#book-step-1").removeClass("badge search-step-active");
                    $("#book-step-2").removeClass("badge search-step-active");
                    $("#book-step-3").addClass("badge search-step-active");

                    $("#step-2").fadeOut();
                    $("#step-3").fadeIn();
                }
            });
        }
    })
})();