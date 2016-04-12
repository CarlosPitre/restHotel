app.controller('clientesController',  function($scope,clienteService,$mdDialog){
	$scope.Clientes = [];
	$scope.Departamentos = [];
    $scope.Municipios = [];
    $scope.Cliente = {};
    $scope.active = false;
    loadClientes();
    loadDepartamentos();


	function loadClientes () {
		var promiseGet = clienteService.getAll();
        promiseGet.then(function (pl) {
            $scope.Clientes = pl.data;
        },
        function (errorPl) {
        	console.log('Error Al Cargar Datos', errorPl);
        });
	}

    function loadDepartamentos () {
       var promiseGet = clienteService.getDepartamentos();
        promiseGet.then(function (pl) {
            $scope.Departamentos = pl.data;
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
    }

    $scope.loadMunicipios = function  () {

        var promiseGet = clienteService.getMunicipios($scope.Cliente.idDepartamento);
        promiseGet.then(function (pl) {
            $scope.Municipios = pl.data;
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
    }

    $scope.nuevo = function  () {
        //initialize();
        $scope.editMode = false;
        $scope.title="Nuevo Cliente";
        $('#modalClientes').openModal();
    };

    $scope.Guardar = function  () {
        object = {
            cedula : $scope.Cliente.cedula,
            nombres : $scope.Cliente.nombres,
            apellidos : $scope.Cliente.apellidos,
            telefono : $scope.Cliente.telefono,
            direccion : $scope.Cliente.direccion,
            correo : $scope.Cliente.correo,
            tipoDoc : $scope.Cliente.tipoDoc
        };
        console.log(object);
        var promisePost = clienteService.post(object);
        promisePost.then(function (pl) {
            if (pl.data == "Not") {
                alert("El Cliente Ya Se Encuentra Registrado Por Favor Verifique.")
                return;
            }
            $('#modalClientes').closeModal();
             Materialize.toast(pl.data, 3000, 'rounded')
            loadClientes();
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
    }

    $scope.editar = function  (cliente) {
        $scope.active = "active";
        alert(JSON.stringify(cliente));
        $scope.Cliente.cedula = cliente.cedulaCliente;
        $scope.Cliente.nombres = cliente.nombresCliente;
        $scope.Cliente.apellidos = cliente.apellidosCliente;
        $scope.Cliente.telefono = cliente.telefonoCliente;
        $scope.Cliente.direccion = cliente.direccionCliente;
        $scope.Cliente.correo = cliente.correoCliente;
        $scope.Cliente.tipoDoc = cliente.tipoDoc;
        $scope.editMode = true;
        $scope.title="Modificar Cliente";
        $('#modalClientes').openModal();
    }

    $scope.modificar = function  () {
        object = {
            cedula : $scope.Cliente.cedula,
            nombres : $scope.Cliente.nombres,
            apellidos : $scope.Cliente.apellidos,
            telefono : $scope.Cliente.telefono,
            direccion : $scope.Cliente.direccion,
            correo : $scope.Cliente.correo,
            tipoDoc : $scope.Cliente.tipoDoc
        };
        console.log(object);
        var promisePut = clienteService.put(object,$scope.Cliente.cedula);
        promisePut.then(function (pl) {
            $('#modalClientes').closeModal();
            Materialize.toast(pl.data, 3000, 'rounded')
            loadClientes();
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
    }

    $scope.remover = function  (cliente) {
        $scope.Cliente.cedula = cliente.cedulaCliente;
        $scope.Cliente.nombres = cliente.nombresCliente;
        $scope.Cliente.apellidos = cliente.apellidosCliente;
        $('#modalEliminar').openModal();
    }

    $scope.eliminar = function  () {
        var promiseDelete = clienteService.delete($scope.Cliente.cedula);
        promiseDelete.then(function (pl) {
            $('#modalEliminar').closeModal();
            Materialize.toast(pl.data, 3000, 'rounded')

            loadClientes();
        },
        function (errorPl) {
            console.log('Error Al Cargar Datos', errorPl);
        });
    }



})
