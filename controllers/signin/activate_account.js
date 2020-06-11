define(['app','api'],function(app){
	app.register.controller('ActivateAccountController',['$rootScope','$scope','api','$uibModal','$timeout',function($rootScope,$scope,api,$uibModal,$timeout){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Account Activation';
			$scope.data={}
			$scope.counter = 5;
			$scope.data.token = window.location.href.split('=')[1];
			
			$scope.getToken();
		};
		
		$scope.getToken = function(){
			var success = function(response){
				$scope.user = response.User;
				$timeout($scope.onTimeout,1000);  
			}
			var error  =function(response){
				console.log(response);
			}
			api.POST('verify_account',$scope.data,success, error);
		}
		
		//REDIRECT TIMEOUT
		$scope.onTimeout = function(){
			if ($scope.counter > 1) {
				$scope.counter--;
				mytimeout = $timeout($scope.onTimeout,1000);
			} else {
				window.location.replace(BASE_URL+'#/login');
			}
		}
	
	}]);
});