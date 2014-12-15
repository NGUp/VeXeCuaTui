(function() {

    'use strict';

    var app = angular.module('search-operator', []);

    app.controller('searchRegulationController', function() {
        this.searchDateFrom = function() {
            window.location = '/admin/regulation?condition=NgayBatDau&key=' + this.search_keyword;
        };

        this.searchDateTo = function() {
            window.location = '/admin/regulation?condition=NgayKetThuc&key=' + this.search_keyword;
        };
    });
})();