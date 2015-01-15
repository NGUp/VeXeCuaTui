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
            var flag;

            flag = true;

            removeNotification("#credit-card");
            removeNotification("#credit-card-id");

            if (/\b(?:3[47]\d|(?:4\d|5[1-5]|65)\d{2}|6011)\d{12}\b/.test($scope.creditCard) == false) {
                showNotification('#credit-card-id', 'Mã thẻ không hợp lệ');
                flag = false;
            }

            if ($("#credit-card-type").val() == "") {
                showNotification('#credit-card', 'Vui lòng chọn loại thẻ');
                flag = false;
            }

            if (flag) {
                var index, tickets, data, ticket;

                tickets = $("#unpaid-tickets").children();
                data = '';

                for (index = 0; index < tickets.length; index++) {
                    ticket = tickets[index];
                    data = data + $($(ticket).children()[1]).html().trim() + ',';
                }

                $.ajax({
                    type: "POST",
                    url: "/syn/payment",
                    data: {
                        "tickets" : data
                    }
                }).done(function(message) {
                    var pattern, reg_err, match, index;

                    pattern = /\[(.*?)\]/igm;
                    reg_err = new RegExp(pattern);

                    if (reg_err.test(message)) {
                        while (match = pattern.exec(message)) {
                            index = pattern.lastIndex;
                        }
                        $("#message-content").html('');
                        $('#error-content').html(message.substring(index, message.length).trim());
                        $('#payment-modal').modal();
                    } else {
                        $("#error-content").html('');
                        $('#message-content').html('Đã thanh toán thành công... Vé sẽ không được giao :v');
                        $('#payment-modal').modal();
                    }
                });
            }
        }

        $scope.paySuccess = function() {
            window.location.href = '/';
        }
    });
})();