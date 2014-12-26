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

            $.ajax({
                type: "POST",
                url: "/syn/gettripinfo",
                data: {
                    'car_id' : $("#car-id").val(),
                    'trip_id'  : $("#route-id").val()
                }
            }).done(function(data) {
                if (typeof(data) === 'object') {
                    obj = data[0];

                    $("#result-operator").html(data[0].TenHangXe);
                    $("#result-date").html(data[0].NgayDi);
                    $("#result-from").html(data[0].NoiDi);
                    $("#result-to").html(data[0].NoiDen);
                    $("#result-price").html(data[0].Gia.format() + " VND");
                    $("#result-logo").attr("src", "/img/Operators/" + data[0].Logo);

                    if (type == "Giường Nằm") {
                        $("#book-bed").show();
                        $("#book-seat").hide();
                    } else {
                        $("#book-bed").hide();
                        $("#book-seat").show();
                    }

                    $("#book-step-1").removeClass("badge search-step-active");
                    $("#book-step-2").addClass("badge search-step-active");
                    $("#book-step-3").removeClass("badge search-step-active");

                    $("#step-2").fadeIn("slow");
                    $("#step-1").fadeOut("slow");
                } else {
                    var pattern, match, index;

                    pattern = /\[(.*?)\]/igm;

                    while (match = pattern.exec(data)) {
                        index = pattern.lastIndex;
                    }
                    $('#error-content').html(data.substring(index, data.length).trim());
                    $('#add-modal').modal();
                }
            });
        });
    })
})();