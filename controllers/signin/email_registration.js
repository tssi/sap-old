define(['app','api'],function(app){
	app.register.controller('EmailRegistrationController',['$rootScope','$scope','api','$uibModal','$timeout',function($rootScope,$scope,api,$uibModal,$timeout){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Email Registration';
			$scope.data={};
			$scope.user = $scope.__USER.user;
			$scope.EmailVerificationSent = false;
			$scope.email_link;
			$scope.sending = false;
			$scope.counter = 10;
			$scope.data.email = "paulobiscocho@gmail.com";
		};
		
		$scope.sendVerification = function(){
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
			api.POST('users/verify_email_account',$scope.data,success, error);
		}
		
		
		
		$scope.registerEmail = function(){
			var success = function(response){
				
				$scope.ValidEmail = true;
				
				$scope.sendVerification();
				$scope.email_link = 'https://'+ $scope.data.email.split("@")[1];
				$scope.sending = true;
				$timeout($scope.onTimeout,1000);  
			}
			var error  =function(response){
				console.log(response);
			}
			$scope.data.id = $scope.user.id;
			//api.POST('users',$scope.data,success, error);
		}
		
		
		
		//REDIRECT TIMEOUT
		$scope.onTimeout = function(){
			if ($scope.counter > 1) {
				$scope.counter--;
				mytimeout = $timeout($scope.onTimeout,1000);
			} else {
				window.location.replace($scope.email_link);
			}
		}
	}]);
});