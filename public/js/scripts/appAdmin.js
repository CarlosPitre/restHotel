var uri = "../";
var app;
(function  () {
	app = angular.module("hotelAdmin", ['ngRoute','ks.ngScrollRepeat']);
	app.config(['$routeProvider', '$locationProvider',function AppConfig($routeProvider,$locationProvider) {
		$routeProvider
			.when("/admin/inicio",{
                    templateUrl: 'pages/admin/inicio.html'
            	}				
			)
			.when("/clientes/inicio", {
                    templateUrl: 'pages/admin/clientes.html'
            	}				
			)
			.when("/habitaciones/inicio", {
                    templateUrl: 'pages/admin/habitaciones.html'
            	}				
			)
			.when("/reservas/inicio", {
                    templateUrl: 'pages/admin/reservas.html'
            	}				
			)
			.when("/check_in/inicio", {
                    templateUrl: 'pages/admin/checkIn.html'
            	}				
			)
			.when("/check_out/inicio", {
                    templateUrl: 'pages/admin/checkOut.html'
            	}				
			)
			.otherwise({
                redirectTo:"admin/inicio"
            });
	}])
})()