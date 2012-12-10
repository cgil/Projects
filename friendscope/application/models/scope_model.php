<?php
class Scope_model extends CI_Model{
	function __contruct(){
		parent::__construct();	
	}
	//Search for the given user id
	function query_uid($target_uid){
		$sql_search = "SELECT access_token, PK_access FROM access WHERE PK_access IN(
				SELECT foreign_pk_access FROM target WHERE target_id = ?
				AND target_works = 1)";
		$result = $this->db->query($sql_search, array($target_uid));
		if($result->num_rows() > 0){
			$result_array = $result->result_array();
			foreach($result_array as $row){
				$access_tokens[] = array($row['access_token'],$row['PK_access']);	
			}
			return $access_tokens;
		}
		else{
			return NULL;	
		}
	}
	
	//Set an access token as not working for a particular target
	function unset_target($target_uid,$origin_pk_access){
		$sql = "UPDATE target SET target_works = 0 
			WHERE target_id = ? AND foreign_pk_access = ?";
		$this->db->query($sql,array($target_uid,$origin_pk_access));
	}
	
	//Delete a user with expired access token
	function unset_user($user_id){
		$pk_access = $this->select_pk_access($user_id);
		$sql = "DELETE FROM access WHERE access_id = ?";
		$this->db->query($sql,array($user_id));	
		
		$this->delete_target_by_user($pk_access);
		
	}
	
	//Delete all targets of a user that has been deleted
	function delete_target_by_user($access_pk){
		$sql = "DELETE FROM target WHERE foreign_pk_access = ?";
		$this->db->query($sql,array($access_pk));	
	}
	
	//Select pk_access by user id
	function select_pk_access($user_id){
		$sql = "SELECT PK_access FROM access WHERE access_id = ?";
		$id = $this->db->query($sql,array($user_id));	
		return $id;	
	}
	
	//Select targets with given name
	function find_similar_friends($target_name){
		//prepare name for query
		$prepared_name = trim($target_name);
		$replace_extras = array(" ",".", "/", "\\", "  ", "\'", "\"", ",");
		$prepared_name = str_replace($replace_extras,"_",$prepared_name);
		$prepared_name = '%'. $prepared_name . '%';
		$sql = "SELECT * FROM target WHERE target_name LIKE ? GROUP BY target_id LIMIT 10";
		$result = $this->db->query($sql,array($prepared_name));
		
		if($result && $result->num_rows()){ 
			return $result->result();
		}
		else{
			return NULL;	
		}
	}
	
}

?>