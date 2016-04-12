var uri = "../";
var app;
(function  () {
	app = angular.module("hotelSerrano", ['ngRoute']);
	app.config(['$routeProvider', '$locationProvider',function AppConfig($routeProvider,$locationProvider) {
		$routeProvider
			.when("/home/inicio",{
                    templateUrl: 'pages/home/inicio.html'
            	}				
			)
			.when("/home/login", {
                    templateUrl: 'pages/home/login.html'
            	}				
			)
			.otherwise({
                redirectTo:"home/inicio"
            });
	}])
})()