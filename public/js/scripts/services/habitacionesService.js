app.service('habitacionesService', function($http){
	this.getAll = function  () {
		var req = $http.get(uri + 'api/habitaciones');
		return req;
	}
	this.getAllCategorias = function  () {
		var req = $http.get(uri + 'api/categorias');
		return req;
	}
	this.post = function  (object) {
		var req = $http.post(uri + 'api/habitaciones',object);
		return req;
	}
})