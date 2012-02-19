<?php
class Cron_job_model extends CI_Model{
	function __contruct(){
		parent::__construct();	
	}
   
	//Return new users that have not brought in their friends list
	function Select_users(){
		$sql = "SELECT PK_access,access_id, access_token
				FROM access
				WHERE access_friends = 0 AND access_token IS NOT NULL
				ORDER BY access_date
				LIMIT 10";
		$sql_update = "UPDATE access SET access_friends = 1
				WHERE access_friends = 0 AND access_token IS NOT NULL
				ORDER BY access_date
				LIMIT 10";	
		$result = $this->db->query($sql);
		$this->db->query($sql_update);
		return $result->result_array();
	}	
	
}

?>