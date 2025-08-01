<?php 
/**
 * Account Page Controller
 * @category  Controller
 */
class AccountController extends SecureController{
	function __construct(){
		parent::__construct(); 
		$this->tablename = "user";
	}
	/**
		* Index Action
		* @return null
		*/
	function index(){
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID; //get current user id from session
		$db->where ("id", $rec_id);
		$tablename = $this->tablename;
		$fields = array("id", 
			"username", 
			"agent_name", 
			"phone_number", 
			"remark", 
			"role", 
			"priority", 
			"status", 
			"pass_text", 
			"agency");
		$allowed_roles = array ('administrator');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("user.username", get_active_user('username') );
		}
		$user = $db->getOne($tablename , $fields);
		if(!empty($user)){
			$page_title = $this->view->page_title = "My Account";
			$this->render_view("account/view.php", $user);
		}
		else{
			$this->set_page_error();
			$this->render_view("account/view.php");
		}
	}
	/**
     * Update user account record with formdata
	 * @param $formdata array() from $_POST
     * @return array
     */
	function edit($formdata = null){
		$request = $this->request;
		$db = $this->GetModel();
		$rec_id = $this->rec_id = USER_ID;
		$tablename = $this->tablename;
		 //editable fields
		$fields = $this->fields = array("id","username","password","pass_text","agent_name","phone_number","remark","role","priority","status","agency");
		if($formdata){
			$postdata = $this->format_request_data($formdata);
			$cpassword = $postdata['confirm_password'];
			$password = $postdata['password'];
			if($cpassword != $password){
				$this->view->page_error[] = "Your password confirmation is not consistent";
			}
			$this->rules_array = array(
				'username' => 'required|valid_email',
				'password' => 'required',
				'pass_text' => 'required',
				'agent_name' => 'required|valid_email',
				'phone_number' => 'required',
				'priority' => 'numeric',
				'status' => 'numeric',
				'agency' => 'required',
			);
			$this->sanitize_array = array(
				'username' => 'sanitize_string',
				'pass_text' => 'sanitize_string',
				'agent_name' => 'sanitize_string',
				'phone_number' => 'sanitize_string',
				'remark' => 'sanitize_string',
				'role' => 'sanitize_string',
				'priority' => 'sanitize_string',
				'status' => 'sanitize_string',
				'agency' => 'sanitize_string',
			);
			$modeldata = $this->modeldata = $this->validate_form($postdata);
			$password_text = $modeldata['password'];
			//update modeldata with the password hash
			$modeldata['password'] = $this->modeldata['password'] = password_hash($password_text , PASSWORD_DEFAULT);
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['username'])){
				$db->where("username", $modeldata['username'])->where("id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['username']." Already exist!";
				}
			}
			//Check if Duplicate Record Already Exit In The Database
			if(isset($modeldata['agent_name'])){
				$db->where("agent_name", $modeldata['agent_name'])->where("id", $rec_id, "!=");
				if($db->has($tablename)){
					$this->view->page_error[] = $modeldata['agent_name']." Already exist!";
				}
			} 
			if($this->validated()){
		$allowed_roles = array ('administrator');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("user.username", get_active_user('username') );
		}
				$db->where("user.id", $rec_id);;
				$bool = $db->update($tablename, $modeldata);
				$numRows = $db->getRowCount(); //number of affected rows. 0 = no record field updated
				if($bool && $numRows){
					$this->set_flash_msg("Yeah! Record updated successfully", "success");
					$db->where ("id", $rec_id);
					$user = $db->getOne($tablename , "*");
					set_session("user_data", $user);// update session with new user data
					return $this->redirect("account");
				}
				else{
					if($db->getLastError()){
						$this->set_page_error();
					}
					elseif(!$numRows){
						//not an error, but no record was updated
						$this->set_flash_msg("No record updated", "warning");
						return	$this->redirect("account");
					}
				}
			}
		}
		$allowed_roles = array ('administrator');
		if(!in_array(strtolower(USER_ROLE), $allowed_roles)){
		$db->where("user.username", get_active_user('username') );
		}
		$db->where("user.id", $rec_id);;
		$data = $db->getOne($tablename, $fields);
		$page_title = $this->view->page_title = "My Account";
		if(!$data){
			$this->set_page_error();
		}
		return $this->render_view("account/edit.php", $data);
	}
	/**
     * Change account email
     * @return BaseView
     */
	function change_email($formdata = null){
		if($formdata){
			$email = trim($formdata['agent_name']);
			$db = $this->GetModel();
			$rec_id = $this->rec_id = USER_ID; //get current user id from session
			$tablename = $this->tablename;
			$db->where ("agent_name", $rec_id);
			$result = $db->update($tablename, array('agent_name' => $email ));
			if($result){
			}
			else{
				$this->set_page_error("Email not changed");
			}
		}
		return $this->render_view("account/change_email.php");
	}
}
