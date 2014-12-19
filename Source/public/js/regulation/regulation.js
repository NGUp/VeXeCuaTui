(function() {

    'use strict';

    var app = angular.module('administrator-regulation', ['header', 'search-operator', "admin-sidebar"]);

    app.controller('regulationController', function() {
        $('.btn-function').click(function() {
            $('.regulation-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });

        $('#tab-regulation').css("color", "#fff");

        this.addRegulation = function() {
            window.location = '/admin/regulation/add';
        };
    });
})();