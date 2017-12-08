(function(){
    var app = angular.module('syscolab', [ ]);


    app.controller("vendaCtrl", [ '$scope', '$http', function($scope, $http) {
        
        $scope.vendaTemp = [ ];
        $scope.novaVendaTemp = { };
        $scope.codigo = [ ];
        $scope.desconto = 0;
        

        var pageTitleWatch = $scope.$watch('localVenda', function () {
    console.log($scope.localVenda);

    $http.get('api/vendaTemp?localVenda='+$scope.localVenda+'').success(function(data, status, headers, config) {
            $scope.vendaTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });

        $scope.$watch('add_payment',function(newVal){
          $scope.add_payment = newVal.replace(/,/g,'.');

        });

        $scope.$watch('desconto',function(newVal){
          $scope.desconto = newVal.replace(/,/g,'.');

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
            	
                var pageTitleWatch = $scope.$watch('localVenda', function () {
    console.log($scope.localVenda);

    $http.get('api/vendaTemp?localVenda='+$scope.localVenda+'').success(function(data, status, headers, config) {
            $scope.vendaTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
                });
        }

       $scope.adicionarVendaCasaTemp = function(codigo){

       		$http.post('api/vendaTemp',{codigo,localVenda:1}).
       		success(function(data, status, headers, config) {
       			$scope.vendaTemp.push(data);
       			
       			reset();
       			var pageTitleWatch = $scope.$watch('localVenda', function () {
    console.log($scope.localVenda);

    $http.get('api/vendaTemp?localVenda='+$scope.localVenda+'').success(function(data, status, headers, config) {
            $scope.vendaTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
       		});
       }

       $scope.adicionarVendaFeiraTemp = function(codigo){

          $http.post('api/vendaTemp',{codigo,localVenda:2}).
          success(function(data, status, headers, config) {
            $scope.vendaTemp.push(data);
            
            reset();
            var pageTitleWatch = $scope.$watch('localVenda', function () {
    console.log($scope.localVenda);

    $http.get('api/vendaTemp?localVenda='+$scope.localVenda+'').success(function(data, status, headers, config) {
            $scope.vendaTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
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