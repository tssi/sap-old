define(['app','api'],function(app){
	app.register.controller('UserManagementController',['$rootScope','$scope','api','$uibModal',function($rootScope,$scope,api,$uibModal){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'User Management';
			$rootScope.$watch('_APP',function($app){
				if (!$app) return;
				getDepartments();
				getUserTypes();
				$scope.ActiveDepartment = {
					"id": "SH",
				};
				$scope.Statuses = [
					{id:'ACTIV',name:'Active'},
					{id:'ARCVD',name:'Archived'}
				];
				$scope.ActivePage = 1;
				$scope.ActiveStatus = {id:'ACTIV',name:'Active'};
				getUsersByActiveStatus();
				
			});
			$scope.IsLoading = true;
			$scope.NoRecords = false;
		};
		
		function getDepartments(){
			var success = function(response){
				$scope.Departments = response.data;
			};
			var error = function(response){
				
			};
			api.GET('educ_levels',success,error);
		};
		
		function getUserTypes(){
			var success = function(response){
				$scope.UserTypes = response.data;
			};
			var error = function(response){
				
			};
			var data = {
				limit:"less",	
			};
			api.GET('user_types',data,success,error);
		};
		
		function getUsersByActiveDepartment(){
			var success = function(response){
				$scope.Users = response.data;
				$scope.NextPage = response.meta.next;
				$scope.PrevPage = response.meta.prev;
				$scope.TotalItems = response.meta.count;
				$scope.LastItem = response.meta.page * response.meta.limit;
				$scope.FirstItem = $scope.LastItem - (response.meta.limit - 1);
				$scope.LastPage = response.meta.last;
				if ($scope.LastItem > $scope.TotalItems){
					$scope.LastItem = $scope.TotalItems;
				};
				if ($scope.CallBack === 1){
					if ($scope.Mode === "edit"){
						if ($scope.TotalItems - (($scope.ActivePage - 1) * 10) === 0){
							$scope.ActivePage--;
						}
						$scope.ActivePage = $scope.ActivePage;
						getUsersByActiveDepartment();
					} else if ($scope.Mode === "add"){
						$scope.ActivePage = $scope.LastPage;
						getUsersByActiveDepartment();
					}
					$scope.CallBack = 0;
				}
				$scope.IsLoading = false;
				$scope.NoRecords = false;
			};
			var error = function(response){
				$scope.IsLoading = false;
				$scope.Users = false;
				$scope.NoRecords = true;
			};
			var data = {
				department_id:$scope.ActiveDepartment.id,
				page:$scope.ActivePage,
				limit:10
			};
			api.GET('users', data, success, error);
		};
		
		function getUsersByActiveStatus(){
			var data = {
				department_id: $scope.ActiveDepartment.id,
				page: $scope.ActivePage,
				status: $scope.ActiveStatus.id,
				limit: 10				
			};
			var success = function(response){
				$scope.Users = response.data;
					console.log(response.data);
				$scope.IsLoading = false;
				$scope.NextPage = response.meta.next;
				$scope.PrevPage = response.meta.prev;
				$scope.TotalItems = response.meta.count;
				$scope.LastItem = response.meta.page * response.meta.limit;
				$scope.FirstItem = $scope.LastItem - (response.meta.limit - 1);
				$scope.LastPage = response.meta.last;
				if ($scope.LastItem > $scope.TotalItems){
					$scope.LastItem = $scope.TotalItems;
				};
			}
			var error = function(response){
				$scope.IsLoading = false;
				$scope.NoRecords = true;
			};
			api.GET('users', data, success, error);
		
		};
		
		$scope.SearchUser = function(){
			$scope.Users = '';
			$scope.IsLoading = 1;
			if(!$scope.SearchWord){
				getUsersByActiveDepartment();
			}
			else{
				var data = {
					keyword:$scope.SearchWord,
					fields:[
					'username'
					],
					department_id:$scope.ActiveDepartment.id,
					status:$scope.ActiveStatus.id,
					limit:9999
				};
				var success = function(response){
					$scope.IsLoading = 0;
					$scope.Users = response.data;
					console.log(response.data);
					
				};
				var error = function(response){
					console.log('error');
					$scope.NoRecords = 1;
					$scope.IsLoading = 0;
				};
				api.GET('users', data, success, error);
			}
		};
		
		$scope.setActiveDepartment = function(dept){
			$scope.IsLoading = true;
			$scope.NoRecords = false;
			$scope.Users = false;
			$scope.ActiveDepartment = dept;
			$scope.ActivePage = 1;
			$scope.ActiveStatus = null;
			getUsersByActiveDepartment();
			$scope.SearchFilters = {
				page:$scope.ActivePage,
				department_id:$scope.ActiveDepartment.id,
				limit:10
			};
		};
		$scope.setActiveStatus = function(stat){
			$scope.NoRecords = false;
			$scope.Users = false;
			$scope.IsLoading = true;
			$scope.OpenFilter = 0;
			$scope.ActiveStatus = stat;
			console.log($scope.ActiveStatus);
			getUsersByActiveStatus();
		};
		$scope.ClearFilter = function(){
			$scope.IsLoading = true;
			$scope.ActiveStatus = '';
			getUsersByActiveDepartment();
		};
		
		$scope.navigatePage = function(page){
			$scope.IsLoading = true;
			$scope.Users = false;
			$scope.ActivePage = page;
			getUsersByActiveDepartment();
		};
		//MODAL
		$scope.openModal = function (data,mode){
			$('#Modal').modal('show');
			$scope.data = {};
			$scope.isReset = false;
			
			if(mode == "edit"){
				$scope.Mode = mode;
				$scope.data = angular.copy(data);
			}else{
				$scope.Mode = 'add';
			}
		}
		
		$scope.cancelModal = function (){
			$('#Modal').modal('hide');
		}
		
		$scope.reset = function(){
			$scope.isReset = true;
		}
		
		$scope.saveModal = function(){
			var success = function(response){
				//This will set Active Department on Save
				$scope.Departments.map(function(item){if(item.id === response.data.department_id)$scope.ActiveDepartment = item;});
				//END
				$('#Modal').modal('hide');
				$scope.CallBack = 1;
				$scope.ActiveStatus = '';
				getUsersByActiveDepartment();
			};
			var error = function(response){
				console.log(response);
			};
			
			if($scope.isReset){
				api.POST('reset_pass', $scope.data, success, error);
			}else{
				api.POST('users',$scope.data, success, error);
			}
		}
		//END MODAL 
	}]);
});