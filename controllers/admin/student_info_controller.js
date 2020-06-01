define(['app','api'],function(app){
	app.register.controller('StudentController',['$rootScope','$scope','api','$uibModal',function($rootScope,$scope,api,$uibModal){
		$scope.init = function(){
			$rootScope.__MODULE_NAME = 'Student Information';
			$rootScope.$watch('_APP',function($app){
				if (!$app) return;
				getDepartments();
				$scope.ActiveDepartment = {
					"id": "SH",
				};
				
				getYearLevels($scope.ActiveDepartment.id);
				
				$scope.Statuses = [
					{id:'ACTIV',name:'Active'},
					{id:'INACT',name:'Inactive'},
					{id:'PENDG',name:'Pending'},
					{id:'LOCKD',name:'Locked'},
					{id:'ARCVD',name:'Archived'}
				];
				$scope.ActivePage = 1;
				getStudentsByActiveDepartment();
				getUsers();
				
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
		
		function getYearLevels(department_id){
			var success = function(response){
				$scope.YearLevels = response.data;
				//console.log($scope.YearLevels[0]);
				//$scope.ActiveYearLevel = $scope.YearLevels[0];
			};
			var error = function(response){
				
			};
			var data = {
				department_id:department_id,
				limit:'less'
			};
			api.GET('year_levels', data, success, error);
		};
		
		function getStudentsByActiveDepartment(){
			var success = function(response){
				$scope.Students = response.data;
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
						getStudentsByActiveDepartment();
					} else if ($scope.Mode === "add"){
						$scope.ActivePage = $scope.LastPage;
						getStudentsByActiveDepartment();
					}
					$scope.CallBack = 0;
				}
				$scope.IsLoading = false;
				$scope.NoRecords = false;
			};
			var error = function(response){
				$scope.IsLoading = false;
				$scope.Students = false;
				$scope.NoRecords = true;
			};
			var data = {
				department_id:$scope.ActiveDepartment.id,
				page:$scope.ActivePage,
				limit:10
			};
			api.GET('students', data, success, error);
		};
		function getStudentsByActiveYearLevel(){
			var data = {
				department_id: $scope.ActiveDepartment.id,
				page: $scope.ActivePage,
				year_level_id: $scope.ActiveYearLevel.id,
				limit: 10				
			};
			var success = function(response){
				$scope.Students = response.data;
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
			api.GET('students', data, success, error);
		};
		function getUsers(){
			var success = function(response){
				$scope.Users = response.data;
				console.log(response);
			};
			var error = function(response){
				
			};
			var data = {
				limit:"less",
				//department_id:$scope.ActiveDepartment.id,
				//user_type_id:'student'
			};
			api.GET('users',data,success,error);
		};
		
		$scope.SearchStudent = function(){
			$scope.Students = '';
			$scope.IsLoading = 1;
			if(!$scope.SearchWord){
				getStudentsByActiveDepartment();
			}
			else{
				if( typeof $scope.ActiveYearLevel === 'undefined'){
					var data = {
						keyword:$scope.SearchWord,
						fields:['first_name','last_name'],
						department_id:$scope.ActiveDepartment.id,
						limit:'less'
					};
				}else{
					var data = {
						keyword:$scope.SearchWord,
						fields:['first_name','last_name'],
						department_id:$scope.ActiveDepartment.id,
						year_level_id:$scope.ActiveYearLevel.id,
						limit:'less'
					};
				}

				var success = function(response){
					$scope.IsLoading = 0;
					$scope.Students = response.data;
					console.log(response.data);
					
				};
				var error = function(response){
					console.log('error');
					$scope.NoRecords = 1;
					$scope.IsLoading = 0;
				};
				api.GET('students', data, success, error);
			}
		};
		
		$scope.setActiveDepartment = function(dept){
			$scope.IsLoading = true;
			$scope.NoRecords = false;
			$scope.Students = false;
			$scope.ActiveDepartment = dept;
			$scope.ActivePage = 1;
			getStudentsByActiveDepartment();
			$scope.SearchFilters = {
				page:$scope.ActivePage,
				department_id:$scope.ActiveDepartment.id,
				limit:10
			};
			getYearLevels($scope.ActiveDepartment.id);
			getUsers();
		};
		
		$scope.setActiveYearLevel = function(lvl){
			$scope.NoRecords = false;
			$scope.Students = false;
			$scope.IsLoading = true;
			$scope.OpenFilter = 0;
			$scope.ActiveYearLevel = lvl;
			getStudentsByActiveYearLevel();
		};
		
		$scope.ClearFilter = function(){
			$scope.IsLoading = true;
			$scope.ActiveYearLevel = '';
			getStudentsByActiveDepartment();
		};
		
		$scope.navigatePage = function(page){
			$scope.IsLoading = true;
			$scope.Students = false;
			$scope.ActivePage = page;
			getStudentsByActiveDepartment();
		};
		
		
		$scope.OpenModal = function (data,mode){
			$('#Modal').modal('show');
			$scope.ModalData = [];
			
			if(mode == "edit"){
				console.log(data);
				$scope.Mode = mode;
				$scope.ModalData = data;
				$scope.Statuses.map(function(item){
					if(item.id === $scope.ModalData.status)
						$scope.ModalData.status = item;
				});
			}else{
				$scope.Mode = "add";
			}
		}
		
		$scope.cancelModal = function (data,mode){
			$('#Modal').modal('hide');
			$scope.Mode = "edit"
			$scope.ActiveDepartment.id = "SH";
			console.log($scope.Mode);
			console.log($scope.ActiveDepartment.id);
			
			$('#Modal').modal('hide');
			
			$scope.CallBack = 1;
			getStudentsByActiveDepartment();
		}
		
		$scope.filterLevel = function(department_id){
			getYearLevels(department_id);
		}
		
		$scope.save = function(){
			var success = function(response){
				//console.log($scope.Mode);
				//console.log($scope.ActiveDepartment.id);
				$('#Modal').modal('hide');
				$scope.CallBack = 1;
				$scope.ActiveStatus = '';
				getStudentsByActiveDepartment();
			};
			var error = function(response){
				console.log(response);
			};
			var data = $scope.ModalData;
			
			var data = {
				id : $scope.ModalData.id, 
				user_id : $scope.ModalData.user_id,
				status : $scope.ModalData.status.id,
				department_id : $scope.ModalData.department.id,
				year_level_id : $scope.ModalData.year_level.id,
				first_name : $scope.ModalData.first_name,
				last_name : $scope.ModalData.last_name,
				middle_name : $scope.ModalData.middle_name,
				suffix : $scope.ModalData.suffix,
				gender : $scope.ModalData.gender,
				
			};
			if(!$scope.ModalData.id){
				data.lrn = "";
				data.sno = "";
			}
			api.POST('students', data, success, error);
			
		}
		
	}]); 
});