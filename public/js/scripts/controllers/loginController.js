app.controller('loginController',  function($scope,loginService){
	$scope.User;
	$scope.Pass;
	$scope.Session;
	$scope.ValidarSesion = function  () {
		if ($scope.User == null) {
			Materialize.toast("Debe Escribir Un Usuario", 3000, "rounded");
			return;	
		}
		if ($scope.Pass == null) {
			Materialize.toast("Debe Escribir Una Contraseña", 3000, "rounded");
			return;	
		}
		var object = {
			user : $scope.User,
			pass : $scope.Pass,
		};
		var promiseGet = loginService.getValidarUsuario(object); 
        promiseGet.then(function (pl) {
            $scope.Session = pl.data;
           	sessionStorage.setItem("usuario",$scope.Session[0].usuario);
           	sessionStorage.setItem("perfil",$scope.Session[0].idperfil);
           	sessionStorage.setItem("estado",$scope.Session[0].estado); 
           	if ($scope.Session[0].estado == "activo") {
           		location.href = "admin.html"; 
           	}

        },
        function (errorPl) {
        	console.log('failure loading Campeonatos', errorPl);
        });
	}
})