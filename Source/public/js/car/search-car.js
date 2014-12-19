(function() {

    'use strict';

    var app = angular.module('search-car', []);

    app.controller('searchCarController', function() {
        this.searchId = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/car",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "condition",
                "value": "BangSoXe",
                "type": "hidden"
            })).append(jQuery("<input>", {
                "name": "key",
                "value": this.search_keyword,
                "type": "hidden"
            })).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));

            newForm.submit();
        };

        this.searchType = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/car",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "condition",
                "value": "Loai",
                "type": "hidden"
            })).append(jQuery("<input>", {
                "name": "key",
                "value": this.search_keyword,
                "type": "hidden"
            })).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));

            newForm.submit();
        };

        this.searchRoute = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/car",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "condition",
                "value": "Tuyen",
                "type": "hidden"
            })).append(jQuery("<input>", {
                "name": "key",
                "value": this.search_keyword,
                "type": "hidden"
            })).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));

            newForm.submit();
        }
    });
})();