<?php
class User extends AppModel {
	var $name = 'User';
	var $recursive = 0;
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'UserType' => array(
			'className' => 'UserType',
			'foreignKey' => 'user_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Student' => array(
			'className' => 'Student',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	/* function beforeFind($queryData){
		//pr($queryData);// exit();
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(!is_array($cond))
					break;
				$keys =  array_keys($cond);
				$search = 'User.department_id';
				
				if(in_array($search,$keys)){
					$value = $cond[$search];
					$yearLevels = $this->YearLevel->find('list',array('conditions'=>array('YearLevel.department_id'=>$value)));
					$year_level_ids = array_keys($yearLevels );
					unset($cond[$search]);
					$cond['User.year_level_id']=$year_level_ids;
				}
				
				$search1 = ['User.first_name LIKE','User.middle_name','User.last_name'];
				
				if(in_array($search1[0],$keys)){
					$val = array_values($cond);
					//pr($val);
					$students = $this->find('list',
								array('conditions'=>
									array('OR'=>array('User.full_name LIKE'=>$val[0],
														'User.sno LIKE'=>$val[0],
														'User.lrn LIKE'=>$val[0]
													)
											)
									)
								);
					//pr($students);exit;
								
					$student_ids= array_keys($students);
					unset($cond['User.first_name LIKE']);
					unset($cond['User.middle_name LIKE']);
					unset($cond['User.last_name LIKE']);
					unset($cond['User.sno LIKE']);
					unset($cond['User.lrn LIKE']);
					$cond['User.id']=$student_ids;
				}
				
				$search2 = 'User.year_level_id';
				if(in_array($search2,$keys)){
					$value = $cond[$search2];
					$students = $this->find('list',array('conditions'=>array('User.year_level_id'=>$value)));
					$student_ids = array_keys($students);
					unset($cond[$search2]);
					unset($cond[$search]);
					$cond['User.id']=$student_ids;
				}

				$conds[$i]=$cond;
			}
			$queryData['conditions']=$conds;
		}
		return $queryData;
	}

 */
}
