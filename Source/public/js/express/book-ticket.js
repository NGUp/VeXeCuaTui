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
            var reg_name, reg_phone, flag;

            flag = true;
            reg_name = new RegExp('^([a-zA-Z ]{0,}[^\u0000-\u007F]{0,})+$');
            reg_phone = new RegExp('^[0-9]{8,11}$');

            removeNotification("#book-name");
            removeNotification("#book-phone");
            removeNotification("#book-email");
            removeNotification("#book-tickets");

            if (reg_name.test($scope.customer) == false || reg_name.exec($scope.customer)[0] !=  $scope.customer) {
                showNotification('#book-name', 'Họ tên không hợp lệ');
                flag = false;
            }

            if (reg_phone.test($scope.phone) == false || reg_phone.exec($scope.phone)[0] !=  $scope.phone) {
                showNotification('#book-phone', 'Số điện thoại không hợp lệ');
                flag = false;
            }

            if ($scope.email == undefined || (/([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})/img).exec($scope.email)['0'] !=  $scope.email) {
                showNotification('#book-email', 'Email không hợp lệ');
                flag = false;
            }

            if ($("#list-seats").val() == "") {
                showNotification('#book-tickets', 'Vị trí ghế không được bỏ trống');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/booktickets",
                    data: {
                        "customer" : $scope.customer,
                        "phone" : $scope.phone,
                        "email" : $scope.email,
                        "tickets" : $("#list-seats").val(),
                        "car" : $("#car-id").val(),
                        "route": $("#route-id").val()
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
                        customer = message;

                        $.ajax({
                            type: "POST",
                            url: "/syn/getunpaidtickets",
                            data: {
                                "customer" : message
                            }
                        }).done(function(data) {
                            seats = data;

                            $("#unpaid-tickets").empty();

                            seats.forEach(function(seat, index) {
                                $("#unpaid-tickets").append("<tr><td>" + (index + 1) +"</td><td>" + seat.MaVe + "</td><td>" + seat.ViTri + "</td><td><button class='btn btn-primary' onclick='removeTicket(this)'>Hủy</button></td></tr>");
                            });

                            $("#total-price").html(($("#price-ticket").val() * seats.length).format() + " VND");

                            $("#book-step-1").removeClass("badge search-step-active");
                            $("#book-step-2").removeClass("badge search-step-active");
                            $("#book-step-3").addClass("badge search-step-active");

                            $("#step-2").fadeOut();
                            $("#step-3").fadeIn();
                        });
                    }
                });
            }
        }
    })
})();