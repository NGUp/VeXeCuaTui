(function() {
    var app = angular.module("search-bar", []);

    app.controller("SearchBarController", function() {
        var today = new Date();

        $('#datetimepicker').datetimepicker({
            pickTime: false,
            defaultDate: today
        });
        $('#datetimepicker').data("DateTimePicker").setMinDate(today);

        $('.combobox').combobox();
        $('.combobox').addClass('form-control');

        $('#search-date').val($('#date').html());
        $($($($('#search-from')).siblings().children()[1]).children()[0]).val($('#from').html());
        $($($($('#search-to')).siblings().children()[1]).children()[0]).val($('#to').html());
    })
})();