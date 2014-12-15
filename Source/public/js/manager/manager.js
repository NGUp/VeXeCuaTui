(function() {

    'use strict';

    var app = angular.module('administrator-manager', ['header', 'search-manager']);

    app.controller('managementController', function() {
        $('.btn-function').click(function() {
            $('.manager-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });

        $('#tab-manager').addClass('backend-side-bar-active');
        $('#tab-operator').removeClass('backend-side-bar-active');

        this.addManager = function() {
            window.location = '/admin/manager/add';
        };


    });
})();