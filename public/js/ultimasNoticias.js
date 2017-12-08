(function(){
    var app = angular.module('syscolab', [ ]);

app.controller("noticiasCtrl", [ '$scope', '$http', function($scope, $http) {


	$scope.noticiasTemp = [ ];
	$scope.novaNoticiaTemp = { };

	$http.get('noticias').success(function(data, status, headers, config) {
            $scope.noticiasTemp = data;
            

               
    }).error(function(e){
      //alert("erro da Api");
      console.log('erro da api');

    });

    $scope.$watch('noticias')

    $scope.adicionarNoticia = function(mensagem){

    	$http.post('noticias', {mensagem}).
       		success(function(data, status, headers, config) {
       			$scope.noticiasTemp.push(data);
       			console.log('Enviada');


       			$scope.log = "Enviado com sucesso";
       			
       			reset();
       		}).error(function(e){
      console.log('erro da api');
    });

    }

    var init = function(){

    	$scope.log = "";

    };

    var reset = function(){
		      $scope.mensagem = [];

	     };




}]);

})();
