(function() {

    'use strict';

    var app = angular.module('search-route', []);

    app.controller('searchRouteController', function() {

        this.searchId = function() {
            window.location = '/admin/route?condition=MaLT&key=' + this.search_keyword;
        };

        this.searchTime = function() {
            window.location = '/admin/route?condition=ThoiGian&key=' + this.search_keyword;
        };

        this.searchRoute = function() {
            window.location = '/admin/route?condition=Tuyen&key=' + this.search_keyword;
        };
    });
})();