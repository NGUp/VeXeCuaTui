(function() {

    'use strict';

    var app = angular.module('moderator-add-car', ['header', "mod-sidebar"]);

    app.controller('addCarController', function() {
        $('.combobox').combobox();
        $('.combobox').addClass('form-control');
        $('#tab-car').css("color", "#fff");

        this.show = true

        this.back = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/car",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));

            newForm.submit();
        };

        this.submit = function() {
            var reg_id, id, type, operator_id, route, flag;

            flag = true;
            reg_id = new RegExp('([0-9]{2})[A-Z]-([0-9]{4}|[0-9]{3}.[0-9]{2})');

            removeNotification('#add-car-id');
            removeNotification('#add-car-type');
            removeNotification('#add-car-operator');
            removeNotification('#add-car-route');

            id = this.car_id;
            type = $('#car-type').val();
            operator_id = $('#car-operator').val();
            route = $('#car-route').val();

            if (reg_id.test(id) == false || reg_id.exec(id)[0] != id) {
                showNotification('#add-car-id', 'Bảng số xe không hợp lệ');
                flag = false;
            }

            if (type == null) {
                showNotification('#add-car-type', 'Loại xe không được để trống');
                flag = false;
            }

            if (operator_id == null) {
                showNotification('#add-car-operator', 'Hãng xe không được để trống');
                flag = false;
            }

            if (route == null) {
                showNotification('#add-car-route', 'Tuyến xe không được để trống');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/addcar",
                    data: {
                        car_id: id,
                        car_type: type,
                        car_operator: operator_id,
                        car_route: route
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
                        event.preventDefault();

                        var newForm = jQuery("<form>", {
                            "action": "/admin/car",
                            "method": "post"
                        }).append(jQuery("<input>", {
                            "name": "operator_id",
                            "value": operator,
                            "type": "hidden"
                        }));

                        newForm.submit();
                    }
                });
            }
        }
    })
})();