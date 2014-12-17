(function() {

    'use strict';

    var app = angular.module("moderator-route", ["header", "mod-sidebar", "search-route"]);

    app.controller("routeController", function() {
        this.addRoute = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/route/add",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));

            var url = "/search.php?q=" + $('#key-word').val();

            newForm.submit();
        };

        $('.btn-function').click(function() {
            $('.route-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });
    });
})();