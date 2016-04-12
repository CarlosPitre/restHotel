app.controller('habitacionesController',function($scope, habitacionesService){
	$scope.Habitaciones = [];
	$scope.Habitacion = {};
	$scope.Categorias = [];
	$scope.active = false;
	loadHabitaciones();
	loadCategorias();
	function loadCategorias () {
		var promiseGet = habitacionesService.getAllCategorias(); 
        promiseGet.then(function (pl) {
            $scope.Categorias = pl.data;
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}
	function loadHabitaciones () {
		var promiseGet = habitacionesService.getAll(); 
        promiseGet.then(function (pl) {
            $scope.Habitaciones = pl.data;
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

	$scope.nuevo = function  () {
		$('#modalHabitaciones').openModal();
	}

	$scope.guardar = function  () {
		var numero;
		if ($scope.Habitacion.numero < 10) {
			numero = $scope.Habitacion.piso + '0' + $scope.Habitacion.numero;
		}else{
			numero = $scope.Habitacion.piso + $scope.Habitacion.numero;
		};
		object = {
			numero :  numero,
			estado : $scope.Habitacion.estado,
			categoria : $scope.Habitacion.categoria,
			camas : $scope.Habitacion.camas,
			piso : $scope.Habitacion.piso,
			precio : $scope.Habitacion.precio 
		};
		console.log(JSON.stringify(object));
		var promisePost = habitacionesService.post(object); 
		promisePost.then(function (pl) {
			if (pl.data == "Not") {
                alert("Ya Existe una Habitación con Ese Numero en ese Piso");
                return;
            }
			$('#modalHabitaciones').closeModal();
            Materialize.toast(pl.data, 3000, 'rounded');
            loadHabitaciones();
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

	$scope.editar = function  (habitacion) {
		$scope.active = "active";
		console.log(JSON.stringify(habitacion));
		//{"idHabitacion":"3","numeroHabitacion":"101","estadoHabitacion":"Disponible","categoria":"Pareja","idCategoria":"2","camas":"2","piso":"1","precio":"40000","$$hashKey":"object:36"}
		$scope.Habitacion.numero = parseInt(habitacion.numeroHabitacion);
		$scope.Habitacion.estado = habitacion.estadoHabitacion;
		$scope.Habitacion.categoria = habitacion.idCategoria;
		$scope.Habitacion.camas = parseInt(habitacion.camas);
		$scope.Habitacion.piso = parseInt(habitacion.piso);
		$scope.Habitacion.precio = habitacion.precio;
		$('#modalHabitaciones').openModal();
	}

})