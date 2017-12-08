(function(){
    var app = angular.module('syscolab', [ ]);

app.controller("estoqueCtrl", [ '$scope', '$http', function($scope, $http) {


	  $scope.estoqueTemp = [ ];
    $scope.novoEstoqueTemp = { };
    $scope.codigo = [ ];
    

    var pageTitleWatch = $scope.$watch('operacao', function () {
    console.log($scope.operacao);

    $http.get('api/estoqueTemp?operacao='+$scope.operacao+'').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
   
    

    

    


    $scope.sum = function(list) {
            var qtde=0;
            angular.forEach(list , function(novoEstoqueTemp){
                qtde+= parseFloat(novoEstoqueTemp.qty);
            });
            return qtde;
    }


    $scope.adicionarEstoqueFeiraTemp = function(codigo){


       		$http.post('api/estoqueTemp',{codigo, operacao: 1}).
          success(function(data, status, headers, config) {
            
            $scope.estoqueTemp.push(data); 
            reset();

            
           var pageTitleWatch = $scope.$watch('operacao', function () {
    console.log($scope.operacao);

    $http.get('api/estoqueTemp?operacao='+$scope.operacao+'').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
          }).error(function(e){
            alert("Produto nao encontrado");
            
            reset();
          });
       }

        $scope.saidaEstoqueFeiraTemp = function(codigo){


          $http.post('api/estoqueTemp',{codigo, operacao: 2}).
          success(function(data, status, headers, config) {
            
            $scope.estoqueTemp.push(data); 
            reset();

            
           var pageTitleWatch = $scope.$watch('operacao', function () {
    console.log($scope.operacao);

    $http.get('api/estoqueTemp?operacao='+$scope.operacao+'').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
          }).error(function(e){
            alert("Produto nao encontrado");
            
            reset();
          });
       }

       $scope.adicionarEstoqueCasaTemp = function(codigo){


          $http.post('api/estoqueTemp',{codigo, operacao: 4}).
          success(function(data, status, headers, config) {
            
            $scope.estoqueTemp.push(data); 
            reset();

            
           var pageTitleWatch = $scope.$watch('operacao', function () {
    console.log($scope.operacao);

    $http.get('api/estoqueTemp?operacao='+$scope.operacao+'').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
          }).error(function(e){
            alert("Produto nao encontrado");
            
            reset();
          });
       }

       $scope.saidaEstoqueCasaTemp = function(codigo){


          $http.post('api/estoqueTemp',{codigo, operacao: 5}).
          success(function(data, status, headers, config) {
            
            $scope.estoqueTemp.push(data); 
            reset();

            
           var pageTitleWatch = $scope.$watch('operacao', function () {
    console.log($scope.operacao);

    $http.get('api/estoqueTemp?operacao='+$scope.operacao+'').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
    });
          }).error(function(e){
            alert("Produto nao encontrado");
            
            reset();
          });
       }

       $scope.removeEstoqueTemp = function(id) {
            $http.delete('api/estoqueTemp/' + id).
            success(function(data, status, headers, config) {
              
                
            
           var pageTitleWatch = $scope.$watch('operacao', function () {
    console.log($scope.operacao);

    $http.get('api/estoqueTemp?operacao='+$scope.operacao+'').success(function(data, status, headers, config) {
            $scope.estoqueTemp = data;

               
    }).error(function(e){
      alert("erro da Api");
    });

    // Now just unbind it after doing your logic
    pageTitleWatch();
    
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
