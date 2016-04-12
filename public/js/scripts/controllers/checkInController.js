app.controller('checkInController', function($scope,reservasService,clienteService){
	
	$scope.Reservas = [];
	$scope.Cliente = {};
	$scope.Habitaciones = [];
	$scope.esconder = false;
	$scope.Reserva={};
	$scope.Acompanantes = [];
	$scope.Acompanante = {};
	$scope.activar = false;
	$scope.Total = 0;
	$scope.title;
	$scope.Restante = $scope.Total;

	$scope.loadCliente = function  () {
		var cedula = $scope.Cliente.cedula;
		var promiseGet = clienteService.get(cedula); 
        promiseGet.then(function (pl) {
        	if (pl.data != null) {
        		$scope.active = "active";
	            $scope.Cliente.nombres = pl.data.nombresCliente;
	            $scope.Cliente.apellidos = pl.data.apellidosCliente;
	            $scope.Cliente.telefono = pl.data.telefonoCliente;
	            $scope.Cliente.correo = pl.data.correoCliente;
	            $scope.Cliente.direccion = pl.data.direccionCliente;
	            buscarReservas(cedula);
        	};
        	
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });

	}

	function buscarReservas (cedula) {
		var promiseGet = reservasService.getReservas(cedula); 
        promiseGet.then(function (pl) {
        	$scope.Reservas = pl.data; 
        	console.log(JSON.stringify($scope.Reservas));       	
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

	$scope.detalles = function  (idReserva) {
		var promiseGet = reservasService.getDetalles(idReserva); 
        promiseGet.then(function (pl) {
        	$scope.Habitaciones = pl.data; 
 			$("#modalDetalles").openModal();  	
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

	$scope.checkIn = function  (reserva) {
		$scope.esconder = true;		
		$scope.Reserva.idReserva =  reserva.idReserva;
		$scope.Reserva.fechaEntrada = reserva.fechaEntrada;
		$scope.Reserva.fechaSalida = reserva.fechaSalida;
		$scope.Reserva.estado = reserva.estado;
		$scope.Total = reserva.valorPago;
	}

	$scope.devolver = function  () {
		$scope.esconder = false;	
	}

	$scope.agregarAcompanante = function  () {
		$scope.title = "Nuevo Acompañante";
		$("#modalAcompanante").openModal();
	}

	$scope.saveAcompanante = function  () {
		$scope.Acompanantes.push(
			{
				documento : $scope.Acompanante.documento,
				nombres : $scope.Acompanante.nombres,
				apellidos : $scope.Acompanante.apellidos,
				direccion : $scope.Acompanante.direccion,
				telefono : $scope.Acompanante.telefono,
			}
		)
	}

	$scope.abonar = function  () {
		var total = $scope.Total;
		var restante =  total - $scope.Reserva.abono;
		$scope.Restante = restante;
		console.log(restante);
	}

	$scope.Guardar = function  () {
		object = {
            reserva : $scope.Reserva.idReserva,
            abono : $scope.Reserva.abono,
            restante : $scope.Restante,
            acompanantes : JSON.stringify($scope.Acompanantes),
        };
        console.log(object);
        var promisePost = reservasService.postCheckIn(object); 
        promisePost.then(function (pl) {
             Materialize.toast(pl.data, 3000, 'rounded')
             console.log(pl.data);
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
	}

})