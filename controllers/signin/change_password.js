define(['app','api'],function(app){
	app.register.controller('ChangePasswordController',['$rootScope','$scope','api','$uibModal',function($rootScope,$scope,api,$uibModal){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Change Password';
			$scope.data={}
			$scope.data.token = window.location.href.split('=')[1];
		
			$scope.getToken();
		};
		
		$scope.getToken = function(){
			var success = function(response){
				$scope.user = response.User;
				console.log(response.User);
			}
			var error  =function(response){
				console.log(response);
			}
			
			api.POST('verify_token',$scope.data,success, error);
		}
		
		$scope.changePassword = function(){
			if($scope.data.password != $scope.data.retype_password){
				alert('Mismatch password. Pls. re-type your password');
				return;
			}
			
			var success = function(response){
				$scope.user = response.User;
				console.log(response.User);
				window.location.replace('http://localhost/sap/#/login');
			}
			var error  =function(response){
				console.log(response);
			}
			$scope.data.id  = $scope.user.id;
			$scope.data.reset_token  = null;
			$scope.data.reset_expiry  = null;
			api.POST('users',$scope.data,success, error);
			
		}
		
	}]);
});