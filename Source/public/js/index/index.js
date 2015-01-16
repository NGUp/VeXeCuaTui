(function() {
    var app = angular.module("index", ["header"]);

    app.controller("bookTicketController", function($scope) {
        var today = new Date();

        $('#datetimepicker').datetimepicker({
            pickTime: false,
            defaultDate: today
        });
        $('#datetimepicker').data("DateTimePicker").setMinDate(today);

        $('.combobox').combobox();
        $('.combobox').addClass('form-control');

        $scope.submit = function() {
            var location_start, location_end, date, reg_date, flag;

            location_start = $('#location-start').val();
            location_end = $('#location-end').val();
            date = $('#date').val();
            reg_date = new RegExp('^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}$');
            flag = true;

            removeNotification($($('#location-start')).siblings()[1]);
            removeNotification($($('#location-end')).siblings()[1]);
            removeNotification('#date');

            if (location_start == null || location_start.length <= 0) {
                showNotification($($('#location-start')).siblings()[1], 'Nơi đi không hợp lệ', 'bottom');
                flag = false;
            }

            if (location_end == null || location_end.length <= 0) {
                showNotification($($('#location-end')).siblings()[1], 'Nơi đến không hợp lệ', 'bottom');
                flag = false;
            }

            if (reg_date.test(date) ==  false || reg_date.exec(date)[0] !=  date) {
                showNotification('#date', "Ngày đi không hợp lệ", "bottom");
                flag = false;
            }

            if (location_start == location_end) {
                showNotification($($('#location-end')).siblings()[1], "Nơi đi không được trùng với nơi đến", "bottom");
                flag = false;
            }

            if (flag) {
                window.location.href = "/express?from=" + location_start + "&to=" + location_end + "&date=" + date;
            }
        }
    });
})();