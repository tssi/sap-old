define(['app','api'],function(app){
	app.register.controller('ChallengeController',['$rootScope','$scope','api','$uibModal','$timeout',function($rootScope,$scope,api,$uibModal,$timeout){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Retrieve Account';
			$scope.ValidSNo =  false;
			$scope.EmailVerificationSent =  false;
			$scope.data = {};
			$scope.data.sno = "2019200552"
			$scope.data.email = "paulobiscocho@gmail.com";
			$scope.email_link;
			$scope.sending = false;
			$scope.counter = 10;
		 
		};
		
		$scope.validateSno = function (){
			var success = function(response){
				if(response.User){
					$scope.ValidSNo =  true;
				}else{
					alert('Invalid or incorrect student no.');
				}
			}
			var error = function(response){console.log(response)}
			
			$scope.data.validation = 'sno';
			api.POST('check',$scope.data,success, error);
		}
		
		$scope.validateEmail = function (){
			var success = function(response){
				if(response.User){
					$scope.User = response.User;
					$scope.sendVerification();
					$scope.email_link = 'https://'+ $scope.data.email.split("@")[1];
					$scope.sending = true;
				}else{
					alert('Invalid or incorrect email address');
				}
			}
			var error  =function(response){}
			$scope.data.validation = 'email';
			api.POST('check',$scope.data,success, error);
		}
	
		$scope.sendVerification = function(){
			var success = function(response){
				if(response){
					$scope.EmailVerificationSent =  true;
					$timeout($scope.onTimeout,1000);  
				}
			}
			var error  =function(response){}
			
			delete $scope.data.validation;
			$scope.data.id = $scope.User.id;
			api.POST('recovery_request',$scope.data,success, error);
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