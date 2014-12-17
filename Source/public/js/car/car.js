(function() {

    'use strict';

    var app = angular.module("moderator-car", ["header", "mod-sidebar", "search-car"]);

    app.controller("carController", function() {
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
    });
})();