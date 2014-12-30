(function() {
    var app = angular.module("search-bar", []);

    app.controller("SearchBarController", function($scope) {
        var today = new Date();

        $('#datetimepicker')
            .datetimepicker({
                pickTime: false,
                defaultDate: today
            })
            .data("DateTimePicker").setMinDate(today);

        $('.combobox').combobox();
        $(".combobox").addClass('form-control');

        $('#search-date').val($('#date').html());

        function getUrlParameter( name )
        {
            name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
            var regexS = "[\\?&]"+name+"=([^&#]*)";
            var regex = new RegExp( regexS );
            var results = regex.exec(window.location.href);
            if( results == null )
                return "";
            else
                return results[1];
        }

        $('#search-from').val(getUrlParameter("from"));
        $('#search-to').val(getUrlParameter("to"));
        $($($($('#search-from')).siblings().children()[1]).children()[0]).val($('#from').html());
        $($($($('#search-to')).siblings().children()[1]).children()[0]).val($('#to').html());

        $scope.submit = function() {
            var location_start, location_end, date, reg_date, flag;

            location_start = $('#search-from').val();
            location_end = $('#search-to').val();
            date = $('#search-date').val();
            reg_date = new RegExp('^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}$');
            flag = true;

            removeNotification($($('#search-from')).siblings()[1]);
            removeNotification($($('#search-to')).siblings()[1]);
            removeNotification('#search-date');

            if (location_start == null || location_start.length <= 0) {
                showNotification($($('#search-from')).siblings()[1], 'Nơi đi không hợp lệ', 'bottom');
                flag = false;
            }

            if (location_end == null || location_end.length <= 0) {
                showNotification($($('#search-to')).siblings()[1], 'Nơi đến không hợp lệ', 'bottom');
                flag = false;
            }

            if (reg_date.test(date) ==  false || reg_date.exec(date)[0] !=  date) {
                showNotification('#search-date', "Ngày đi không hợp lệ", "bottom");
                flag = false;
            }

            if (location_start == location_end) {
                showNotification($($('#search-to')).siblings()[1], "Nơi đi không được trùng với nơi đến", "bottom");
                flag = false;
            }

            if (flag) {
                window.location.href = "/express?from=" + location_start + "&to=" + location_end + "&date=" + date;
            }
        }
    })
})();