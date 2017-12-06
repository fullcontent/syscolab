(function(){
    var app = angular.module('syscolab', [ ]);


    app.controller("vendaCtrl", [ '$scope', '$http', function($scope, $http) {
        
        $scope.vendaTemp = [ ];
        $scope.novaVendaTemp = { };
        $scope.codigo = [ ];
        

        $http.get('api/vendaTemp').success(function(data, status, headers, config) {
            $scope.vendaTemp = data;

        });

        $scope.$watch('add_payment',function(newVal){
          $scope.add_payment = newVal.replace(/,/g,'.');
        });


        
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(novaVendaTemp){
                total+= parseFloat(novaVendaTemp.item.valor * novaVendaTemp.qtde);
            });
            return total;
        }

        $scope.removeVendaTemp = function(id) {
            $http.delete('api/vendaTemp/' + id).
            success(function(data, status, headers, config) {
            	
                $http.get('api/vendaTemp').success(function(data) {
                        $scope.vendaTemp = data;
                        });
                });
        }

       $scope.adicionarVendaTemp = function(codigo){

       		$http.post('api/vendaTemp',{codigo}).
       		success(function(data, status, headers, config) {
       			$scope.vendaTemp.push(data);
       			
       			reset();
       			$http.get('api/vendaTemp').success(function(data){
       				$scope.vendaTemp = data;
       				
       			});
       		});
       }

       $scope.atualizaVendaTemp = function(novaVendaTemp) {
            
            $http.put('api/vendaTemp/' + novaVendaTemp.id, {qtde: novaVendaTemp.qtde, total: novaVendaTemp.qtde * novaVendaTemp.valor}).
            success(function(data, status, headers, config){
      	
            	         		
            });

            
        }

      

       var reset = function(){
		      $scope.codigo = [];
	     };

		


    }]);



})();