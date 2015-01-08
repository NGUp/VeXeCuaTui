function removeTicket(element) {
    var index, tickets, ticket;
    tickets = $("#unpaid-tickets").children();

    for (index = 0; index < tickets.length; index++) {
        ticket = tickets[index];
        $($(ticket).children()[0]).html(index + 1);
    }

    $.ajax({
        type: "POST",
        url: "/syn/removeticket",
        data: {
            "ticket" : $($($(element).parents()[1]).children()[1]).html(),
            "car" : $("#car-id").val(),
            "route" : $("#route-id").val(),
            "seat" : $($($(element).parents()[1]).children()[2]).html()
        }
    }).done(function(data) {

        $($(element).parents()[1])
            .fadeOut()
            .remove();
    });
}

(function() {
    var app = angular.module("payment", []);

    app.controller("paymentController", function($scope) {
        $scope.pay = function() {
            console.log("Pay");
        }
    });
})();