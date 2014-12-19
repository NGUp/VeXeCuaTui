(function() {

    'use strict';

    var app = angular.module('administrator-operator', ['header', 'search-operator', "admin-sidebar"]);

    app.controller('operatorController', function() {
        $('.btn-function').click(function() {
            $('.operator-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });

        $('#tab-operator').css("color", "#fff");

        this.addOperator = function() {
            window.location = '/admin/operator/add';
        };
    });
})();