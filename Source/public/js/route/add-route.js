(function() {

    'use strict';

    var storage = {};

    var app = angular.module('moderator-add-route', ['header', "mod-sidebar"]);

    app.controller("addRouteController", function($scope) {

        $('#datetimepicker-time').datetimepicker({
            pickDate: false
        });

        $('.datetimepicker').datetimepicker({
            pickTime: false,
            defaultDate: moment().format("DD/MM/YYYY")
        });

        var Provinces = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '/js/data/provinces.json',
                filter: function(list) {
                    return $.map(list, function(province) {
                        return { name: province }; });
                }
            }
        });
        Provinces.initialize();

        $('.combobox').combobox();
        $('.combobox').addClass('form-control');
        $('#tab-route').css("color", "#fff");

        $('#add-route-stop').tagsinput({
            typeaheadjs: {
                name: 'Provinces',
                displayKey: 'name',
                valueKey: 'name',
                source: Provinces.ttAdapter()
            }
        });

        storage.start_time = this.route_start_time;

        this.back = function() {
            window.location = '/admin/route';
        };

        this.submit = function() {

            var start_date, start_time, start_location, end_location, price, stop;
            var reg_date, reg_time, reg_price, flag;

            reg_date = new RegExp('^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)[0-9]{2}$');
            reg_time = new RegExp('([0-9]|1[0-2]):([0-5][0-9]) (AM|PM)');
            reg_price = new RegExp('[1-9]([0-9]{5,})');

            removeNotification('#add-route-start-date');
            removeNotification('#add-route-start-time');
            removeNotification('#start-location');
            removeNotification('#end-location');
            removeNotification('#add-route-price');
            removeNotification('#add-route-stop');

            flag = true;
            start_date = $('#add-route-start-date').val();
            start_time = $('#add-route-start-time').val();
            start_location = $('#add-route-start-location').val();
            end_location = $('#add-route-end-location').val();
            price = $('#add-route-price').val();
            stop = $('#add-route-stop').val();

            if (reg_date.test(start_date) ==  false || reg_date.exec(start_date)[0] !=  start_date) {
                showNotification('#add-route-start-date', 'Ngày đi không hợp lệ');
                flag = false;
            }

            if (reg_time.test(start_time) ==  false || reg_time.exec(start_time)[0] != start_time) {
                showNotification('#add-route-start-time', 'Giờ đi không hợp lệ');
                flag = false;
            }

            if (reg_price.test(price) ==  false || reg_price.exec(price)[0] != price) {
                showNotification('#add-route-price', 'Giá vé không hợp lệ');
                flag = false;
            }

            if (start_location == undefined || start_location == null || start_location.length == 0) {
                showNotification('#start-location', 'Nơi đi không hợp lệ');
                flag = false;
            }

            if (end_location == undefined || end_location == null || end_location.length == 0) {
                showNotification('#end-location', 'Nơi đến không hợp lệ');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/addroute",
                    data: {
                        operator_id: $('#operator-id').val(),
                        route_start_time: start_time,
                        route_start_date: start_date,
                        route_start_location: start_location,
                        route_end_location: end_location,
                        route_price: parseInt(price),
                        route_stop: stop
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
                        $('#add-modal').modal();
                    } else {
                        window.location.href = '/admin/route';
                    }
                });
            }
        };
    })
})();