(function() {

    'use strict';

    var app = angular.module("delete-car", []);

    app.controller("deleteCarController", function() {
        this.submitDelete = function() {
            $.ajax({
                type: "POST",
                url: "/syn/deletecar",
                data: {
                    car_id: $('.car-id').val()
                }
            }).done(function(message) {
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
            });
        }
    });
})();