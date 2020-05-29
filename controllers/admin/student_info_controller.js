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
				
				getYearLevels();
				
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
		
		function getYearLevels(){
			var success = function(response){
				$scope.YearLevels = response.data;
				//console.log($scope.YearLevels[0]);
				//$scope.ActiveYearLevel = $scope.YearLevels[0];
			};
			var error = function(response){
				
			};
			var data = {
				department_id:$scope.ActiveDepartment.id,
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
			getYearLevels();
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
		
		$scope.OpenModal = function(modalstudent,mode){
			if (!mode){
				mode = "add";
			}
			$scope.Mode = mode;
			var departments = $scope.Departments;
			var users = $scope.Users;
			var statuses = $scope.Statuses;
			var yearlevels = $scope.YearLevels;
			var config = {
				templateUrl:"ModalContent.html",
				controller:"StudentModalController",
				resolve:{
					Departments:function(){
						return departments;
					},
					Users:function(){
						return users;
					},
					YearLevels:function(){
						return yearlevels;
					},
					Statuses:function(){
						return statuses;
					},
					ModalStudent:function(){
						return modalstudent;
					},
					Mode:function(){
						return mode;
					}
				}
			};
			var modal = $uibModal.open(config);
			var promise = modal.result;
			var callback = function(activedept){
				$scope.CallBack = 1;
				$scope.ActiveDepartment.id = activedept;
				console.log(activedept);
				getStudentsByActiveDepartment();
			};
			var fallback = function(){
			};
			promise.then(callback,fallback);
		};
		
	}]);
	app.register.controller('StudentModalController',['$scope','$uibModalInstance','api','Departments','YearLevels','Users','Statuses','ModalStudent','Mode',function($scope,$uibModalInstance,api,Departments,YearLevels,Users,Statuses,ModalStudent,Mode){
	
		$scope.idle = true;
		$scope.Departments = angular.copy(Departments);
		$scope.Users = angular.copy(Users);
		$scope.Statuses = angular.copy(Statuses);
		$scope.YearLevels = angular.copy(YearLevels);
		$scope.ModalStudent = {};
		$scope.Mode = angular.copy(Mode);
		
		
		if ($scope.Mode === "edit"){
			
			$scope.Department = {};
			$scope.Department.id = $scope.ModalStudent.department_id;
			$scope.ModalStudent = angular.copy(ModalStudent);
				console.log($scope.ModalStudent);
			$scope.Statuses.map(function(item){
				if(item.id === $scope.ModalStudent.status)
					$scope.ModalStudent.status = item;
			});
		}
		
		$scope.chooseGender = function(gender){
			switch (gender){
				case "male":
					$scope.ModalStudent.gender = "M";
				break;
				case "female":
					$scope.ModalStudent.gender = "F";
				break;
			}
		};
		
		$scope.setActiveDepartment = function(department){
			$scope.ActiveDepartment = department;
			$scope.ModalStudent.department_id = department.id;
		};
		
		$scope.cancelModal = function(){
			$uibModalInstance.dismiss();
		};
		
		$scope.confirmModal = function(){
			$scope.idle = false;
			if($scope.Mode === 'add'){
				var success = function(response){
					$uibModalInstance.close($scope.ModalStudent.department_id);
				};
				var error = function(response){
					
				};
				
				var data =  angular.copy($scope.ModalStudent);
					data.status =  $scope.ModalStudent.status.id;
					console.log($scope.ModalStudent.status.id);
				api.POST('students',data,success,error);
			}
			
			if ($scope.Mode === "edit"){
				var success = function(response){
					$uibModalInstance.close($scope.ModalStudent.department_id);
				};
				
				var error = function(response){
					console.log(response);
				};
				var data = {
					id : $scope.ModalStudent.id, 
					user_id : $scope.ModalStudent.user_id,
					status : $scope.ModalStudent.status.id,
					department_id : $scope.ModalStudent.department_id,
					first_name : $scope.ModalStudent.first_name,
					last_name : $scope.ModalStudent.last_name,
					middle_name : $scope.ModalStudent.middle_name,
					suffix : $scope.ModalStudent.suffix
					
				};
				data.action = "edit";
				console.log(data);
				var dept_id = {
					id : $scope.ModalStudent.user_id,
					department_id: $scope.ModalStudent.department_id
				};
				if($scope.ModalStudent.user_id!=null){
					api.POST('users', dept_id, success, error);
					//api.POST('students', data, success, error);
				}
				api.POST('students', data, success, error);
			}
			
		};
		
		$scope.deleting = false;
		$scope.deleteModal = function(){
			$scope.deleting = true;
			var success = function(response){
				$uibModalInstance.close($scope.ModalStudent.department_id);
			};
			var error = function(response){
				
			};
			var data = {id:$scope.ModalStudent.id};
			api.DELETE('students', data, success, error);
		};
	}]);
});