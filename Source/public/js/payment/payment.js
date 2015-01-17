angular.module("payment", ["header"])
    .controller("paymentController", function($scope) {
        $('.btn-function').click(function() {
            $scope.ticket_id = $($($(this).parents()[1]).find('.col-id')[0]).html().trim();
        });

        $scope.pay = function() {

        };

        $scope.remove = function() {
            $.ajax({
                type: "POST",
                url: "/syn/cancelticket",
                data: {
                    "ticket" : $scope.ticket_id
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
                    $('#remove-ticket-modal').modal('hide');
                    $($('#col-' + $scope.ticket_id).parents()[0])
                        .fadeOut('slow')
                        .remove();
                }
            });
        };
    });