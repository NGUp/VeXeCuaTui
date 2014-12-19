(function() {

    'use strict';

    var app = angular.module("moderator-car", ["header", "mod-sidebar", "search-car", "delete-car"]);

    app.controller("carController", function() {
        this.operator_id = operator;

        $('#tab-car').css("color", "#fff");

        this.addCar = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/car/add",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));

            newForm.submit();
        }

        $('.btn-function').click(function() {
            $('.car-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });
    });
})();