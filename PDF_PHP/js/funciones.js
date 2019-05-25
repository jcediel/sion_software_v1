angular.module('firts', [])
   .controller("listado",function($scope,$http){
    $scope.posts=[];
   	$http.get("controler/controladores.php")
   	.success(function(data){
   		$scope.posts = data;
   	})
   	.error(function(err) {
   	});  


 $scope.exportar_excel = function() {
    $("#frm_excel").submit();
  };


 });
