<?php
class Student extends AppModel {
	var $name = 'Student';
	var $recursive = 2;
	var $virtualFields = array(
				'name'=>"CONCAT(Student.sno,' - ',Student.first_name,' ',Student.last_name)",
				'short_name'=>"CONCAT(LEFT(Student.first_name,1),'.',Student.last_name)",
				'full_name'=>"CONCAT(Student.first_name,' ',LEFT(Student.middle_name,1),' ',Student.last_name,' ',Student.suffix)",
				'class_name'=>"UPPER(CONCAT(Student.last_name,', ',Student.prefix, Student.first_name,' ',LEFT(Student.middle_name,1),'. ',Student.suffix))"
				);
	var $displayField = 'name';
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'YearLevel' => array(
			'className' => 'YearLevel',
			'foreignKey' => 'year_level_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function beforeFind($queryData){
		//pr($queryData);// exit();
		if($conds=$queryData['conditions']){
			foreach($conds as $i=>$cond){
				if(!is_array($cond))
					break;
				$keys =  array_keys($cond);
				$search = 'Student.department_id';
				
				if(in_array($search,$keys)){
					$value = $cond[$search];
					$yearLevels = $this->YearLevel->find('list',array('conditions'=>array('YearLevel.department_id'=>$value)));
					$year_level_ids = array_keys($yearLevels );
					unset($cond[$search]);
					$cond['Student.year_level_id']=$year_level_ids;
				}
				
				$search1 = ['Student.first_name LIKE','Student.middle_name','Student.last_name'];
				
				if(in_array($search1[0],$keys)){
					$val = array_values($cond);
					//pr($val);
					$students = $this->find('list',
								array('conditions'=>
									array('OR'=>array('Student.full_name LIKE'=>$val[0],
														'Student.sno LIKE'=>$val[0],
														'Student.lrn LIKE'=>$val[0]
													)
											)
									)
								);
					//pr($students);exit;
								
					$student_ids= array_keys($students);
					unset($cond['Student.first_name LIKE']);
					unset($cond['Student.middle_name LIKE']);
					unset($cond['Student.last_name LIKE']);
					unset($cond['Student.sno LIKE']);
					unset($cond['Student.lrn LIKE']);
					$cond['Student.id']=$student_ids;
				}
				
				$search2 = 'Student.year_level_id';
				if(in_array($search2,$keys)){
					$value = $cond[$search2];
					$students = $this->find('list',array('conditions'=>array('Student.year_level_id'=>$value)));
					$student_ids = array_keys($students);
					unset($cond[$search2]);
					unset($cond[$search]);
					$cond['Student.id']=$student_ids;
				}
				
				$search3 = 'Student.user_id';
				if(in_array($search3,$keys)){
					$value = $cond[$search3];
					$students = $this->find('list',array('conditions'=>array('Student.user_id'=>$value)));
					//pr($students);
					$student_ids = array_keys($students);
					unset($cond[$search3]);
					unset($cond[$search2]);
					unset($cond[$search]);
					$cond['Student.id']=$student_ids;
				}

				$conds[$i]=$cond;
			}
			$queryData['conditions']=$conds;
		}
		return $queryData;
	}
}
