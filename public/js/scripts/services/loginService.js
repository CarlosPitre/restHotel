app.service('loginService', function($http){
	this.getValidarUsuario = function  (object) {
		var req = $http.post(uri+'api/login',object);
		return req;
	};
	this.getMenu = function  (idPerfil) {
		var req = $http.get(uri+'api/menu/'+idPerfil);
		return req;
	}
})