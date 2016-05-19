<?php
 class admin{
 	private $_db,
 			$_data,
 			$_sessionName,
 			$_cookieName,
 			$_isLoggedIn;
 

 	public function __construct($user = null){
 		$this->_db = DB::getInstance();

 		$this->_sessionName = config::get('session/session_name');
 		$this->_cookieName = config::get('remember/cookie_name');
 		if(!$user){
 			if(session::exists($this->_sessionName)){
 				$user = session::get($this->_sessionName);

 				if($this->find($user)){
 					$this->_isLoggedIn = true;
 				}else{
 					//
 				}
 			}
 		}else{
 			$this->find($user);
 		}

 	}


 	public function hasPermission($key){
 		$group = $this->_db->get('groups',array('id','=',$this->data()->group));
 		if($group->count()){
 		$permissions = json_decode($group->first()->permissions,true);
 		if(isset($permissions[$key])){
 		if($permissions[$key] == true){
 			return true;
 			}	
 		}
 		
 		}
 		return false;
 	}

 	public function update($fields = array(), $id = null){
 		if(!$id && $this->isLoggedIn()){
 			$id = $this->data()->id;
 		}

 		if(!$this->_db->update('users',$id,$fields)){
 			throw new Exception("there was a problem while updating.");
 		}
 	}
	
	public function update_admission($table,$dept,$fields = array()){
 		if(!$this->_db->update_table($table,$dept,$fields)){
 			throw new Exception("there was a problem while updating admission.");
 		}
 	}
	
	
 	public function create($table,$fields = array()){
		print_r($fields); 
 		if(!$this->_db->insert($table,$fields)){
 			throw new Exception("There was a problem in uploading results!");
 		}
 	}
	
	public function placement_create($fields = array()){
 		if(!$this->_db->insert('placement',$fields)){
 			throw new Exception("There was a problem in updating placement table!");
 		}
 	}
	
	
	public function result_create($fields = array()){
 		if(!$this->_db->insert('result',$fields)){
 			throw new Exception("There was a problem in updating result table!");
 		}
 	}
	
	public function admission_create($fields = array()){
 		if(!$this->_db->insert('admission',$fields)){
 			throw new Exception("There was a problem in updating admission table!");
 		}
 	}
	
	 public function get_result($reg_num){
			$field = 'reg_num';
 			$data = $this->_db->get_assoc('result',array($field, '=' ,$reg_num ));
 			if($data->count()){
 				$this->_data = $data->first();
 				return true;
 			}
 		return false; 
 	}
	
	
	public function get_hall($reg_num){
			$field = 'reg_no';
 			$data = $this->_db->get_assoc('hall_allot',array($field, '=' ,$reg_num ));
 			if($data->count()){
 				$this->_data = $data->first();
 				return true;
 			}
 		return false; 
 	}

	
	public function get_date($table){
			$field = '`table`';
 			$data = $this->_db->get_assoc('last_updated',array($field, '=' ,$table ));
 			if($data->count()){
 				$this->_data = $data->first();
 				return true;
 			}
 		return false; 
 	}
	
	
 	public function find($user = null){
 		if($user){
 			$field = (is_numeric($user)) ? 'id' : 'username';
 			$data = $this->_db->get('users',array($field, '=' ,$user ));
 			if($data->count()){
 				$this->_data = $data->first();
 				return true;
 			}
 		}
 		return false; 
 	}
	
	public function find_response($user = null){
 		if($user){
 			$field = (is_numeric($user)) ? 'id' : 'username';
 			$data = $this->_db->get('users',array($field, '=' ,$user ));
 			if($data->count()){
 				$this->_data = $data->first();
 				return $data->first();
 			}
 		}
 		return false; 
 	}
	
	
 	public function login($username = null,$password = null,$remember = false){
 		if(!$username &&          !$password && $this->exists()){
 			session::put($this->_sessionName,$this->data()->id);
 		}else{

	 		$user = $this->find($username);
	 		if($user){
	 			if($this->data()->password === hash::make($password,$this->data()->salt)){
	 				session::put($this->_sessionName,$this->data()->id);
	 				
	 				if($remember){
	 					$hash = hash::unique();
	 		 			$hashcheck = $this->_db->get('user_sessions',array('user_id','=',$this->data()->id)); 
	  					if(!$hashcheck->count()){
	 						$this->_db->insert('user_sessions',array(
	 							'user_id' => $this->data()->id,
	 							'hash' => $hash
	 							));
	 					}else{
	 						$hash = $hashcheck->first()->hash;
	 					}

	 					cookies::put($this->_cookieName,$hash,config::get('remember/cookie_expiry'));
	 				}

	 				return true;
	 			}	
	 		}
	 	}
 		return false;
 	}

	 	public function login_response($username = null,$password = null){
	 		$user = $this->find($username);
	 		if($user){
	 			if($this->data()->password === hash::make($password,$this->data()->salt)){
	 				return $this->data()->id;
	 			}	
	 		}
 		return false;
 	}

	
	
 	public function exists(){
 		return (!empty($this->_data)) ?true : false;
 	}
 	public function logout(){

 		$this->_db->delete('user_sessions',array('user_id','=',$this->data()->id));
 		session::delete($this->_sessionName);
 		cookies::delete($this->_cookieName);
 	}
 	public function data(){
 		return $this->_data;
 	}
 	public function isLoggedIn(){
 		return $this->_isLoggedIn;
 	}

 }


?>