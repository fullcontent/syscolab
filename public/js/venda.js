(function(){
    var app = angular.module('syscolab', [ ]);


    app.controller("vendaCtrl", [ '$scope', '$http', function($scope, $http) {
        
        $scope.vendaTemp = [ ];
        $scope.novaVendaTemp = { };
        $scope.codigo = [ ];
        

        $http.get('http://localhost/syscolab/public/api/vendaTemp').success(function(data, status, headers, config) {
            $scope.vendaTemp = data;

        });

        
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(novaVendaTemp){
                total+= parseFloat(novaVendaTemp.item.valor * novaVendaTemp.qtde);
            });
            return total;
        }

        $scope.removeVendaTemp = function(id) {
            $http.delete('http://localhost/syscolab/public/api/vendaTemp/' + id).
            success(function(data, status, headers, config) {
            	
                $http.get('http://localhost/syscolab/public/api/vendaTemp').success(function(data) {
                        $scope.vendaTemp = data;
                        });
                });
        }

       $scope.adicionarVendaTemp = function(codigo){

       		$http.post('http://localhost/syscolab/public/api/vendaTemp',{codigo}).
       		success(function(data, status, headers, config) {
       			$scope.vendaTemp.push(data);
       			
       			reset();
       			$http.get('http://localhost/syscolab/public/api/vendaTemp').success(function(data){
       				$scope.vendaTemp = data;
       				
       			});
       		});
       }

       $scope.atualizaVendaTemp = function(novaVendaTemp) {
            
            $http.put('http://localhost/syscolab/public/api/vendaTemp/' + novaVendaTemp.id, {qtde: novaVendaTemp.qtde, total: novaVendaTemp.qtde * novaVendaTemp.valor}).
            success(function(data, status, headers, config){
      	
            	         		
            });

            
        }

       var reset = function(){
		$scope.codigo = [];
	};

		


    }]);



})();