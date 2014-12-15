(function() {

    'use strict';

    var app = angular.module('administrator-operator', ['header', 'search-operator']);

    app.controller('operatorController', function() {
        $('.btn-function').click(function() {
            $('.operator-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });

        $('#tab-manager').removeClass('backend-side-bar-active');
        $('#tab-operator').addClass('backend-side-bar-active');

        this.addOperator = function() {
            window.location = '/admin/operator/add';
        };
    });
})();