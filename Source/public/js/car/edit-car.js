(function() {

    'use strict';

    var app = angular.module('moderator-edit-car', ['header', "mod-sidebar"]);

    app.controller('editCarController', function() {
        $('.combobox').combobox();
        $('.combobox').addClass('form-control');

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
            var type, route, flag;

            removeNotification('#edit-car-type');
            removeNotification('#edit-car-route');

            flag = true;
            type = $('#car-type').val();
            route = $('#car-route').val();

            if (type == null) {
                showNotification('#edit-car-type', 'Loại xe không được để trống');
                flag = false;
            }

            if (route == null) {
                showNotification('#edit-car-route', 'Tuyến xe không được để trống');
                flag = false;
            }

            if (flag) {
                $.ajax({
                    type: "POST",
                    url: "/syn/editcar",
                    data: {
                        car_id: $('#edit-car-id').html(),
                        car_type: type,
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
                        $('#edit-modal').modal();
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
    });
})();