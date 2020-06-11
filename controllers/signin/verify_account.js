define(['app','api'],function(app){
	app.register.controller('VerifyAccountController',['$rootScope','$scope','api','$uibModal','$timeout',function($rootScope,$scope,api,$uibModal,$timeout){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Verify Account';
			$scope.data={};
			$scope.user = $scope.__USER.user;
			$scope.EmailVerificationSent = false;
			$scope.email_link;
			$scope.sending = false;
			$scope.counter = 10;
			$scope.data.email = "paulobiscocho@gmail.com";
			$scope.data.token = window.location.href.split('=')[1];
			if($scope.user.is_activated) window.location.replace(BASE_URL);
		};
		
		$scope.register = function(){
			var success = function(response){
				if(response){
					$scope.EmailVerificationSent =  true;
					$scope.email_link = 'https://'+ $scope.data.email.split("@")[1];
					$timeout($scope.onTimeout,1000);  
				}
			}
			var error  =function(response){}
			
			$scope.sending =  true;
			$scope.data.id = $scope.user.id;
			api.POST('email_registration',$scope.data,success, error);
		}
		
		//REDIRECT TIMEOUT
		$scope.onTimeout = function(){
			if ($scope.counter > 1) {
				$scope.counter--;
				mytimeout = $timeout($scope.onTimeout,1000);
			} else {
				window.open($scope.email_link);
			}
		}
	}]);
});