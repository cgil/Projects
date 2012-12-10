<?php
class Store_access_token_model extends CI_Model{
	function __contruct(){
		parent::__construct();	
	}
	//Search db and store this access token if it is unique
	function store_access_tok($access_token){
		$user = $this->facebook->getUser();
		if(!$user){//user doesnt exist
			//Redirect to facebook oauth page
			redirect('/login/','refresh');
		}
		$userData = $this->facebook->api('/me');
		$this->load->helper('date');
		
		//Create the user variables 
		$uid = $userData['id'];
		$fname = (!isset($userData['first_name'])) ? "" : $userData['first_name'];
		$mname = (!isset($userData['middle_name'])) ? "" : $userData['middle_name'];
		$lname = (!isset($userData['last_name'])) ? "" : $userData['last_name'];
		$location = (!isset($userData['location']['name'])) ? "" : $userData['location']['name'];
		
		//query by unique user id
		$sql = "SELECT * FROM access WHERE access_id = ?";
		$result = $this->db->query($sql, array($uid));
		
		if($result->num_rows() > 0){
			//User already in database, update necessary information
			$update_sql = "UPDATE access SET 
				`access_token` = ?, `access_fname` = ?, `access_mname` = ?, `access_lname` = ?,
				`access_location` = ?, `access_date` = ?
				WHERE `PK_access` = ?";
			$this->db->query($update_sql, array($access_token,
					$fname, $mname, $lname,$location,mysql_datetime(),
					$result->row()->PK_access));
		}
		else{
			//First time insert
			$insert_sql = "INSERT INTO access
				SET
				`access_id` = ?, `access_token` = ?, `access_fname` = ?, 
				`access_mname` = ?, `access_lname` = ?,`access_location` = ?, `access_date` = ? ";
				$this->db->query($insert_sql, array($uid,
					$access_token,$fname,$mname,$lname,
					$location,mysql_datetime()));
		}
	}
}

?>