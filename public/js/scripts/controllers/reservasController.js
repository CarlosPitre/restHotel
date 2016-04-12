app.controller('reservasController', function($scope,habitacionesService,clienteService,reservasService){
	$scope.Habitaciones = [];
	$scope.Habitacion = {};
	$scope.Cliente = {};
	$scope.total = 0;
	$scope.HabitacionesSeleccionadas = [];
	$scope.active = false;
	$scope.Reserva = {};
	loadHabitaciones();
	function loadHabitaciones () {
		var promiseGet = habitacionesService.getAll(); 
        promiseGet.then(function (pl) {
            $scope.Habitaciones = pl.data;
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}
	$scope.loadCliente = function  () {
		var cedula = $scope.Cliente.cedula;
		//alert(cedula)
		var promiseGet = clienteService.get(cedula); 
        promiseGet.then(function (pl) {
        	if (pl.data != null) {
        		$scope.active = "active";
	            $scope.Cliente.nombres = pl.data.nombresCliente;
	            $scope.Cliente.apellidos = pl.data.apellidosCliente;
	            $scope.Cliente.telefono = pl.data.telefonoCliente;
	            $scope.Cliente.correo = pl.data.correoCliente;
	            $scope.Cliente.direccion = pl.data.direccionCliente;
        	};
        	
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

	$scope.agregarHabitacion = function  () {
		$scope.HabitacionesSeleccionadas = [];
		$('input[name="habitacion[]"]:checked').each(function() {
			$scope.HabitacionesSeleccionadas.push({
				idHabitacion : $(this).val(),
			});
		});
		$scope.total = 0;
		for (var i = 0; i < $scope.HabitacionesSeleccionadas.length; i++) {
			for (var j = 0; j < $scope.Habitaciones.length; j++) {
				if ($scope.Habitaciones[j].numeroHabitacion ==  $scope.HabitacionesSeleccionadas[i].idHabitacion) {
					$scope.total = parseInt($scope.total) + parseInt($scope.Habitaciones[j].precio);
				}; 
			};
		};
	}

	$scope.guardarReserva = function  () {
		var fechaEntrada = new Date(Date.parse($scope.Reserva.fechaEntrada));
		var fechaSalida = new Date(Date.parse($scope.Reserva.fechaSalida));

		object = {
            cedula : $scope.Cliente.cedula,
            fechaEntrada : fechaEntrada,
            fechaSalida : fechaSalida,
            valorPago : $scope.total,
            habitaciones : JSON.stringify($scope.HabitacionesSeleccionadas),
        };
        console.log(object);
        var promisePost = reservasService.post(object); 
        promisePost.then(function (pl) {
            Materialize.toast(pl.data.mensaje, 3000, 'rounded')
            //location.reload();
            inicializar();
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
	}

function inicializar () {
	$scope.Reserva = {};
	loadHabitaciones();
	$scope.Cliente = {};
	$scope.Total = 0;
}

})