define(['app','api'],function(app){
	app.register.controller('ResetPasswordController',['$rootScope','$scope','api','$uibModal',function($rootScope,$scope,api,$uibModal){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Reset Password';
		};
	}]);
});