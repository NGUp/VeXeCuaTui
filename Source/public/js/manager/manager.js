(function() {

    'use strict';

    var app = angular.module('administrator-manager', ['header', 'search-manager', "admin-sidebar"]);

    app.controller('managementController', function() {
        $('.btn-function').click(function() {
            $('.manager-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });

        $('#tab-manager').css("color", "#fff");

        this.addManager = function() {
            window.location = '/admin/manager/add';
        };
    });
})();