(function() {
    var app = angular.module("search-result", []);

    app.controller("FindingTripController", function($scope) {
        $(".btn-book-ticket").click(function() {
            $("#trip-id").val($($($(this).parents()[1]).children()[6]).html().trim());

            var type = $($($(this).parents()[1]).children()[4]).html().trim();

            if (type == "Giường Nằm") {
                $("#book-seat").hide();
            } else {
                $("#book-bed").hide();
            }

            $("#step-1").hide();
            $("#step-2").show();
        });
    })
})();