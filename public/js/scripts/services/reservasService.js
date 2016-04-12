app.service('reservasService', function($http){
	this.post = function  (object) {
		var req = $http.post(uri+'api/reservas',object);
		return req;
	}
	this.getReservas = function  (cedula) {
		var req = $http.get(uri+'api/cliente/' + cedula + '/reservas');
		return req;
	}
	this.getDetalles = function  (idReserva) {
		var req = $http.get(uri+'api/reserva/'+idReserva+'/habitaciones');
		return req;
	}
	this.postCheckIn = function  (object) {
		var req = $http.post(uri+'api/checkin', object);
		return req;
	}
})