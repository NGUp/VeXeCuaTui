(function() {

    'use strict';

    var app = angular.module('administrator-regulation', ['header', 'search-operator']);

    app.controller('regulationController', function() {
        $('.btn-function').click(function() {
            $('.regulation-id').val($($(this).parents()[1]).find('.col-id')[0].innerHTML.trim());
        });

        $('#tab-manager').removeClass('backend-side-bar-active');
        $('#tab-operator').addClass('backend-side-bar-active');

        this.addRegulation = function() {
            window.location = '/admin/regulation/add';
        };
    });
})();