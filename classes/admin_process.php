<?php
require_once 'DB.php';
require_once 'core/init.php';	
require_once 'classes/PHPExcel/IOFactory.php';
class admin_process{
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
	

	
	
	
	
	public function result_via_gcm($registatoin_id,$fields){
						$gcm=new GCM();
						$message='Results has been uploaded';	
						$gcm_id = $this->_db->query("select gcm_id from users where reg_no = '$registatoin_id'");
						$gcm_id = $gcm_id->first();
						$registatoin_ids = $gcm_id->gcm_id;
						
						if(!empty($registatoin_ids)){
						$registatoin_ids = array($registatoin_ids);
						$message = array("price"=>$message,"result"=>$fields);
						$result = $gcm->send_notification($registatoin_ids,$message);
						return $result;
						}else{
						return 'gcm id not found';
						}
	}
	
	public function add_hall_using_excel_sheet($filename){
		$data = new Spreadsheet_Excel_Reader($filename);
		for($i=0;$i<count($data->sheets);$i++){
				if(count($data->sheets[$i]['cells'])>0){
					for($j=1;$j<=count($data->sheets[$i]['cells']);$j++){ 
						$admin=new admin();
						try{
					$admin->create('hall_allot',array(
						'reg_no' => $data->sheets[$i]['cells'][$j][1],
						'hall_no' => $data->sheets[$i]['cells'][$j][2]
						));
						

				}catch(Exception $e){
				die($e->getMessage());
			}
			

						}
					}
				}
		
				session::flash('hall','your allotments are added successfully!');
				redirect::to('hall_upload.php');
		}
	
	
	
	
	public function add_user_using_excel_sheet($filename){
		$data = new Spreadsheet_Excel_Reader($filename);
		for($i=0;$i<count($data->sheets);$i++){
				if(count($data->sheets[$i]['cells'])>0){
					for($j=1;$j<=count($data->sheets[$i]['cells']);$j++){ 
						$this->_validate->check($data->sheets[$i]['cells'][$j], array(
						1=> array(
						'required' => true,
						'min' => 2,
						'max' => 20,
						'unique' => 'users'
						)));
						$salt = hash::salt(32);
						$user=new user();
						
						
						try{
					$user->create(array(
						'username' => $data->sheets[$i]['cells'][$j][1],
						'password' => hash::make('skcet123',$salt),
						'salt' => $salt,
						'name' => $data->sheets[$i]['cells'][$j][2],
						'reg_no' => $data->sheets[$i]['cells'][$j][3],
						'roll_no' => $data->sheets[$i]['cells'][$j][4],
						'department' => $data->sheets[$i]['cells'][$j][5],
						'year' => $data->sheets[$i]['cells'][$j][6],
						'section' => $data->sheets[$i]['cells'][$j][7],
						'joined' => date('Y-m-d H:i:s'),
						'group' => $data->sheets[$i]['cells'][$j][8],
						'designation' =>$data->sheets[$i]['cells'][$j][9],
						'user_type' =>$data->sheets[$i]['cells'][$j][10],
						'phone' => $data->sheets[$i]['cells'][$j][11],
						'mail' => $data->sheets[$i]['cells'][$j][12]
						));
					//session::flash('home','your registeration is successful! ur are free to login!');
					//redirect::to('index.php');
				}catch(Exception $e){
				die($e->getMessage());
			}
			

						}
					}
				}
		}	
		
		
		
		
	public function list_users($name){
	$this->_db->query1("SELECT * FROM users where username LIKE '{$name}%'");
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