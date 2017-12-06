(function(){
    var app = angular.module('syscolab', [ ]);

app.controller("estoqueCtrl", [ '$scope', '$http', function($scope, $http) {


	  $scope.estoqueTemp = [ ];
    $scope.novoEstoqueTemp = { };
    $scope.codigo = [ ];

    $http.get('api/estoqueTemp').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;
   
    }).error(function(e){
    	alert("erro da ");
    });


    $scope.sum = function(list) {
            var qtde=0;
            angular.forEach(list , function(novoEstoqueTemp){
                qtde+= parseFloat(novoEstoqueTemp.qty);
            });
            return qtde;
    }


    $scope.adicionarEstoqueTemp = function(codigo){


       		$http.post('api/estoqueTemp',{codigo, operacao: 1}).
       		success(function(data, status, headers, config) {
            
       			$scope.estoqueTemp.push(data); 
       			reset();
       			$http.get('api/estoqueTemp').success(function(data){
       			$scope.estoqueTemp = data;
       				

       			});
       		}).error(function(e){
       			alert("Produto nao encontrado");
            
       			reset();
       		});
       }


       $scope.removeEstoqueTemp = function(id) {
            $http.delete('api/estoqueTemp/' + id).
            success(function(data, status, headers, config) {
            	
                $http.get('api/estoqueTemp').success(function(data) {
                        $scope.estoqueTemp = data;
                        });
                });
        }

        $scope.saidaEstoqueTemp = function(codigo){


          $http.post('api/estoqueTemp',{codigo, operacao: 0}).
          success(function(data, status, headers, config) {
            
            $scope.estoqueTemp.push(data); 
            reset();
            $http.get('api/estoqueTemp').success(function(data){
            $scope.estoqueTemp = data;
              

            });
          }).error(function(e){
            alert("Produto nao encontrado");
            
            reset();
          });
       }

        var reset = function(){
		      $scope.codigo = [];
	     };

}]);

})();
