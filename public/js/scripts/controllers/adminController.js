app.controller('adminController',  function($scope,loginService){
	$scope.Menu = [];
	$scope.Usuario = sessionStorage.usuario;
	$scope.idPerfil = sessionStorage.perfil;
	loadMenu();


	function loadMenu () {
		//alert($scope.Usuario)
		var promiseGet = loginService.getMenu($scope.idPerfil); 
        promiseGet.then(function (pl) {
            $scope.Menu = pl.data;
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

})