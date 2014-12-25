(function() {
    var app = angular.module("search-result", []);

    app.controller("FindingTripController", function($scope) {
        $(".btn-book-ticket").click(function() {
            $("#car-id").val($($($(this).parents()[1]).children()[6]).html().trim());
            $("#route-id").val($($($(this).parents()[1]).children()[7]).html().trim());

            var type = $($($(this).parents()[1]).children()[4]).html().trim();

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

                    if (type == "Giường Nằm") {
                        $("#book-bed").show();
                        $("#book-seat").hide();
                    } else {
                        $("#book-bed").hide();
                        $("#book-seat").show();
                    }

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