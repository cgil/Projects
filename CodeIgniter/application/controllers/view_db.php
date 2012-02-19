<?php
/*	Query the database
 */
 
class View_db extends CI_Controller{

	function __construct(){
		parent::__construct();
		//Enter your Application Id and Application Secret keys
        $config['appId'] = '';
        $config['secret'] = '';

        //Do you want cookies enabled?
        $config['cookie'] = true;
        
        //load Facebook php-sdk library with $config[] options
        $this->load->library('facebook', $config);
	}
	
	function index(){
		$this->view_access();	
	}
	
	//View access db data
	function view_access(){
		$sql= "SELECT * FROM access";
		$data['query'] = $this->db->query($sql)->result();
		$this->load->view('view_db',$data);
	}
	
	//View target db data by target_uid
	function view_target(){		
		$entered_uid = $this->uri->segment(3);
		$data['query'] = 'Failed query';
		if($entered_uid){
			$target_uid = $this->Get_real_uid($entered_uid);
			$sql = "SELECT * FROM target WHERE target_id = ?";
			$data['query'] = $this->db->query($sql,array($target_uid))->result();
		}
		$this->load->view('view_db',$data);
	}
	
	//Given a username find the targets user id
	function Get_real_uid($entered_uid){
		if(is_numeric($entered_uid)){
			//The entered number is a user id
			return $entered_uid;	
		}
		else{
			//Query facebook and get user id from the username
			try{
				$requested_profile = $this->facebook->api('/'.$entered_uid);
			} catch (FacebookApiException $e){
				error_log($e);
				echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
				return NULL;	
			}
			$target_uid = $requested_profile['id'];
			if(is_numeric($target_uid) && $target_uid != NULL && $target_uid != ""){
				return $target_uid;
			}
			else{
				return NULL;
			}
		}
	}
	 
	 
}

?>