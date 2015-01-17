(function() {
    var app = angular.module("search-result", []);

    app.controller("FindingTripController", function($scope) {
        $(".btn-book-ticket").click(function() {
            $("#car-id").val($($($(this).parents()[1]).children()[6]).html().trim());
            $("#route-id").val($($($(this).parents()[1]).children()[7]).html().trim());

            var type = $($($(this).parents()[1]).children()[4]).html().trim();

            Number.prototype.format = function(n, x) {
                var re = '(\\d)(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
                return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$1,');
            };

            initBed = function() {
                var index;

                for (index = 1; index < 31; index++) {
                    $("#seat-bed-" + index)
                        .removeClass()
                        .addClass("seat-available");
                }
            };

            initSeat = function() {
                var index;

                for (index = 1; index < 46; index++) {
                    $("#seat-" + index)
                        .removeClass()
                        .addClass("seat-available");
                }
            };

            checkBookedSeat = function(data) {
                if (data != null) {
                    var res = data.split(",");

                    res.forEach(function(seat) {
                        $("#seat-" + seat)
                            .removeClass()
                            .addClass("seat-booked");
                    });
                }
            };

            checkBookedBed = function(data) {
                if (data != null) {
                    var res = data.split(",");

                    res.forEach(function(seat) {
                        $("#seat-bed-" + seat)
                            .removeClass()
                            .addClass("seat-booked");
                    });
                }
            };

            $.ajax({
                type: "POST",
                url: "/syn/gettripinfo",
                data: {
                    'car_id' : $("#car-id").val(),
                    'trip_id'  : $("#route-id").val()
                }
            }).done(function(data) {
                if (typeof(data) === 'object') {
                    var obj, count;

                    obj = data[0];

                    try {
                        $(".result-operator").html(obj.TenHangXe);
                        $(".result-date").html(obj.NgayDi);
                        $(".result-from").html(obj.NoiDi);
                        $(".result-to").html(obj.NoiDen);
                        $(".result-price").html(obj.Gia.format() + " VND");
                        $(".result-logo").attr("src", "/img/Operators/" + obj.Logo);
                        $("#price-ticket").val(obj.Gia);

                        if (type == "Giường Nằm") {
                            count = 30;
                            initBed();
                            checkBookedBed(obj.GheDaDat);
                            $("#book-bed").show();
                            $("#book-seat").hide();
                        } else {
                            count = 40;
                            initSeat();
                            checkBookedSeat(obj.GheDaDat);
                            $("#book-bed").hide();
                            $("#book-seat").show();
                        }

                        $('.count-available-seat').html(count - (obj.GheDaDat == null ? 0 : obj.GheDaDat.split(",").length - 1));

                        $("#book-step-1").removeClass("badge search-step-active");
                        $("#book-step-2").addClass("badge search-step-active");
                        $("#book-step-3").removeClass("badge search-step-active");

                        $("#step-2").fadeIn("slow");
                        $("#step-1").fadeOut("slow");
                    } catch(err) {
                        $('#error-content').html('Có vấn đề xảy ra. Vui lòng nhấn F5.');
                        $('#err-modal').modal();

                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }

                } else {
                    var pattern, match, index;

                    pattern = /\[(.*?)\]/igm;

                    while (match = pattern.exec(data)) {
                        index = pattern.lastIndex;
                    }
                    $('#error-content').html(data.substring(index, data.length).trim());
                    $('#err-modal').modal();
                }
            });
        });
    })
})();