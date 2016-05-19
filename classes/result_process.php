<?php
require_once 'DB.php';
require_once 'core/init.php';	
class result_process{
	private $_db,
			$_validate,
			$_sql;
	public function __construct(){
	$this->_db=DB::getInstance();
	$this->_validate=new validate();
	}
	public function getValidate(){
		return $this->validate;
	}
	
	public function add_result_using_excel_sheet($filename){
		
		$admin_result = new admin_process();
		$data = new Spreadsheet_Excel_Reader($filename);
		for($i=0;$i<count($data->sheets);$i++){
				if(count($data->sheets[$i]['cells'])>0){
					for($j=1;$j<=count($data->sheets[$i]['cells']);$j++){
						if(isset($data)){
						
						$admin=new admin();
						try{
						$admin->create('result',array(
						'reg_num' => $data->sheets[$i]['cells'][$j][1],
						'date_of_exam' => $data->sheets[$i]['cells'][$j][2],
						'batch' => $data->sheets[$i]['cells'][$j][3],
						'sem' => $data->sheets[$i]['cells'][$j][4],
						'name_of_student' => $data->sheets[$i]['cells'][$j][5],
						'department' => $data->sheets[$i]['cells'][$j][6],
						'arrear' => $data->sheets[$i]['cells'][$j][7],
						'sub_name_1' => $data->sheets[$i]['cells'][$j][8],
						'sub_code_1' => $data->sheets[$i]['cells'][$j][9],
						'sub_grade_1' => $data->sheets[$i]['cells'][$j][10],
						'sub_name_2' => $data->sheets[$i]['cells'][$j][11],
						'sub_code_2' => $data->sheets[$i]['cells'][$j][12],
						'sub_grade_2' => $data->sheets[$i]['cells'][$j][13],
						'sub_name_3' => $data->sheets[$i]['cells'][$j][14],
						'sub_code_3' => $data->sheets[$i]['cells'][$j][15],
						'sub_grade_3' => $data->sheets[$i]['cells'][$j][16],
						'sub_name_4' => $data->sheets[$i]['cells'][$j][17],
						'sub_code_4' => $data->sheets[$i]['cells'][$j][18],
						'sub_grade_4' => $data->sheets[$i]['cells'][$j][19],
						'sub_name_5' => $data->sheets[$i]['cells'][$j][20],
						'sub_code_5' => $data->sheets[$i]['cells'][$j][21],
						'sub_grade_5' => $data->sheets[$i]['cells'][$j][22],
						'sub_name_6' => $data->sheets[$i]['cells'][$j][23],
						'sub_code_6' => $data->sheets[$i]['cells'][$j][24],
						'sub_grade_6' => $data->sheets[$i]['cells'][$j][25],
						'sub_name_7' => $data->sheets[$i]['cells'][$j][26],
						'sub_code_7' => $data->sheets[$i]['cells'][$j][27],
						'sub_grade_7' => $data->sheets[$i]['cells'][$j][28],
						'sub_name_8' => $data->sheets[$i]['cells'][$j][29],
						'sub_code_8' => $data->sheets[$i]['cells'][$j][30],
						'sub_grade_8' => $data->sheets[$i]['cells'][$j][31],
						'sub_name_9' => $data->sheets[$i]['cells'][$j][32],
						'sub_code_9' => $data->sheets[$i]['cells'][$j][33],
						'sub_grade_9' => $data->sheets[$i]['cells'][$j][34]
						));
						
						
		
						echo $admin_result->result_via_gcm($data->sheets[$i]['cells'][$j][1] ,array(
						'reg_num' => $data->sheets[$i]['cells'][$j][1],
						'date_of_exam' => $data->sheets[$i]['cells'][$j][2],
						'batch' => $data->sheets[$i]['cells'][$j][3],
						'sem' => $data->sheets[$i]['cells'][$j][4],
						'name_of_student' => $data->sheets[$i]['cells'][$j][5],
						'department' => $data->sheets[$i]['cells'][$j][6],
						'arrear' => $data->sheets[$i]['cells'][$j][7],
						'sub_name_1' => $data->sheets[$i]['cells'][$j][8],
						'sub_code_1' => $data->sheets[$i]['cells'][$j][9],
						'sub_grade_1' => $data->sheets[$i]['cells'][$j][10],
						'sub_name_2' => $data->sheets[$i]['cells'][$j][11],
						'sub_code_2' => $data->sheets[$i]['cells'][$j][12],
						'sub_grade_2' => $data->sheets[$i]['cells'][$j][13],
						'sub_name_3' => $data->sheets[$i]['cells'][$j][14],
						'sub_code_3' => $data->sheets[$i]['cells'][$j][15],
						'sub_grade_3' => $data->sheets[$i]['cells'][$j][16],
						'sub_name_4' => $data->sheets[$i]['cells'][$j][17],
						'sub_code_4' => $data->sheets[$i]['cells'][$j][18],
						'sub_grade_4' => $data->sheets[$i]['cells'][$j][19],
						'sub_name_5' => $data->sheets[$i]['cells'][$j][20],
						'sub_code_5' => $data->sheets[$i]['cells'][$j][21],
						'sub_grade_5' => $data->sheets[$i]['cells'][$j][22],
						'sub_name_6' => $data->sheets[$i]['cells'][$j][23],
						'sub_code_6' => $data->sheets[$i]['cells'][$j][24],
						'sub_grade_6' => $data->sheets[$i]['cells'][$j][25],
						'sub_name_7' => $data->sheets[$i]['cells'][$j][26],
						'sub_code_7' => $data->sheets[$i]['cells'][$j][27],
						'sub_grade_7' => $data->sheets[$i]['cells'][$j][28],
						'sub_name_8' => $data->sheets[$i]['cells'][$j][29],
						'sub_code_8' => $data->sheets[$i]['cells'][$j][30],
						'sub_grade_8' => $data->sheets[$i]['cells'][$j][31],
						'sub_name_9' => $data->sheets[$i]['cells'][$j][32],
						'sub_code_9' => $data->sheets[$i]['cells'][$j][33],
						'sub_grade_9' => $data->sheets[$i]['cells'][$j][34]
						));
						
						
						

						
				}catch(Exception $e){
				die($e->getMessage());
			}
			}
			}
		}
		}
					session::flash('result','your Results has been uploaded successfully!');
					redirect::to('result_upload.php');

	}
	
	public function list_result($name){
	$this->_db->query1("SELECT * FROM result where reg_num LIKE '{$name}%'");
		$result=$this->_db->results();
		$html="<table class='table table-hover'><th>ID</th><th>USERNAME</th><th>DEPARTMENT</th>
		<th>DESIGNATION</th><th>JOINED</th><th></th>";
		for($x=0;$x<sizeof($result);$x++){
			$html.="<tr>";
				$html.="<td>".$result[$x]["id"]."</td>";
				$html.="<td>".$result[$x]["username"]."</td>";
				
				$html.="<td>".$result[$x]["joined"]."</td>";
				$html.='<td><a class="anchor"href="'.$result[$x]['id'].'">delete</a>';
			 $html.="<tr>";
		}
		$html.="</table>";
		echo $html;
	}
	public function delete_user($id){
		$this->_db->delete("users",array('id','=',$id));
	}
}	