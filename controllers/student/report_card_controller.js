define(['app','api'],function(app){
	app.register.controller('ReportCardController',['$rootScope','$scope','api','$uibModal',function($rootScope,$scope,api,$uibModal){
		$scope.init = function(){
			//console.log($scope.__USER);
			$scope.getStudent();
		};
		
		
		$scope.getStudent = function(){
			var success = function(response){
				$scope.Student = response.data[0];
				$scope.report_src = "api/pdf/"+$scope.Student.lrn+".pdf";
				console.log($scope.Student);
			};
			var error = function(response){
				
			};
			var data = {
				user_id:$scope.__USER.user.id,	
				limit:"less",	
			};
			api.GET('students',data,success,error);
		};
		
		
		
	}]);
});