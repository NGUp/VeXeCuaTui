(function() {
    var app = angular.module("mod-sidebar", []);

    app.controller("sidebarController", function() {
        this.editOperator = function() {
            event.preventDefault();

            var newForm = jQuery("<form>", {
                "action": "/admin/operator/edit",
                "method": "post"
            }).append(jQuery("<input>", {
                "name": "operator_id",
                "value": operator,
                "type": "hidden"
            }));
            newForm.submit();
        };

        this.routeManagement = function() {
            window.location.href = "/admin/route";
        };

        this.routeCar = function() {
            window.location.href = "/admin/car";
        };
    });
})();