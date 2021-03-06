(function() {
    var app = angular.module("book-ticket", []);

    app.controller("BookTicketController", function($scope) {
        if (window.localStorage.ID == undefined) {
            $('#customer-required').show();
            $scope.accept = function() {
                $("#user-modal").modal('show');
            }
        } else {
            $('#customer-information').show();

            $scope.back = function() {
                $("#result-operator").empty();
                $("#result-date").empty();
                $("#result-from").empty();
                $("#result-to").empty();
                $("#result-price").empty();

                $scope.customer = '';
                $scope.phone = '';
                $scope.email = '';
                $("#list-seats").tagsinput('removeAll');

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

                    $("#seat-bed-" + event.item)
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

                    if ($("#seat-bed-" + event.item)[0] == undefined || $("#seat-bed-" + event.item)[0].className == "seat-booked") {
                        event.cancel = true;
                    } else {
                        $("#seat-bed-" + event.item)
                            .removeClass()
                            .addClass("seat-checked");
                    }
                }
            );

            $scope.pay = function() {
                var flag;

                flag = true;
                removeNotification("#book-tickets");

                if ($("#list-seats").val() == "") {
                    showNotification('#book-tickets', 'Vị trí ghế không được bỏ trống');
                    flag = false;
                }

                if (flag) {
                    $.ajax({
                        type: "POST",
                        url: "/syn/booktickets",
                        data: {
                            "customer" : window.localStorage.ID,
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
                            function formattedDate(date) {
                                var d = new Date(date || Date.now()),
                                    month = '' + (d.getMonth() + 1),
                                    day = '' + d.getDate(),
                                    year = d.getFullYear();

                                if (month.length < 2) month = '0' + month;
                                if (day.length < 2) day = '0' + day;

                                return [day, month, year].join('/');
                            }

                            $.ajax({
                                type: "POST",
                                url: "/syn/getunpaidtickets",
                                data: {
                                    "customer" : window.localStorage.ID,
                                    "car" : $("#car-id").val(),
                                    "date_register" : formattedDate(),
                                    "date_start" : $(".result-date").html()
                                }
                            }).done(function(data) {
                                seats = data;

                                var price = 0;

                                $("#unpaid-tickets").empty();

                                seats.forEach(function(seat, index) {
                                    $("#unpaid-tickets").append("<tr><td>" + (index + 1) +"</td><td>" + seat.MaVe + "</td><td>" + seat.ViTri + "</td><td><button class='btn btn-primary' onclick='removeTicket(this)'>Hủy</button></td></tr>");
                                    price += seat.GiaVe;
                                });

                                $("#total-price").html(price.format() + " VND");

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
        }
    })
})();