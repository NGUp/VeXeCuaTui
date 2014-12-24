(function() {
    var app = angular.module("search-result", []);

    app.controller("FindingTripController", function($scope) {
        $(".btn-book-ticket").click(function() {
            $("#trip-id").val($($($(this).parents()[1]).children()[6]).html().trim());

            var type = $($($(this).parents()[1]).children()[4]).html().trim();

            if (type == "Giường Nằm") {
                $("#book-bed").show();
                $("#book-seat").hide();
            } else {
                $("#book-bed").hide();
                $("#book-seat").show();
            }

            $("#step-2").fadeIn("slow");
            $("#step-1").fadeOut("slow");
        });
    })
})();