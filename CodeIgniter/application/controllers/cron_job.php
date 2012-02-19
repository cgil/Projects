<?php
/* Routine tasks that move around large bulks of data, executed behind the scenes */
class Cron_job extends CI_Controller{
	function __contruct(){
		parent::__construct();	
		//Enter your Application Id and Application Secret keys
        $config['appId'] = '';
        $config['secret'] = '';

        //Do you want cookies enabled?
        $config['cookie'] = true;
        
        //load Facebook php-sdk library with $config[] options
        $this->load->library('facebook', $config);
	}
	
	//Insert a new users friends into the database as searcheable targets
	function index(){
		$this->load->model('Cron_job_model');
		$this->load->model('Bulk_insert_model');
		$new_users = $this->Cron_job_model->Select_users();
		echo "Compiling new users friendslists to bring in....................<br/>";
		foreach($new_users as $user){
			//Get this users friends
			$friendslist = $this->Get_friends($user['access_id'],$user['access_token']);
			if(!is_null($friendslist)){
				//Prepare the array for insertion into db
				$friendslist = $this->Prepare_array($friendslist,$user['PK_access']);
				//Insert the prepared array into db
				$this->Bulk_insert_model->Insert_targets($friendslist);
				echo "Successfully initiated: " . $user['access_id'] . "<br/>"; 
			}
			else{
				echo "Failed: Could not get friends list";	
			}
		}
		echo "Done!<br/>";
	}
	
	//Get a users friends
	function Get_friends($user_id,$access_token){
		//Enter your Application Id and Application Secret keys
        $config['appId'] = '';
        $config['secret'] = '';

        //Do you want cookies enabled?
        $config['cookie'] = true;
		$this->load->library('facebook', $config);
		try{
			$params['access_token'] = $access_token;
			$params['limit'] = 4000;
			$friends = $this->facebook->api('/'.$user_id .'/friends',$params);
		} catch (FacebookApiException $e){
			error_log($e);
			echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			$friends = NULL;	
		}
		return $friends;
	}

	//Helper: add foreign access key to array and prepare for insert
	function Prepare_array($array,$foreign_access){
		if (is_array($array) && count($array) > 0) {
		  if(isset($array['data'])){
			$count = count($array['data']);
			for ($i = 0; $i < $count; $i++) {
				$array['data'][$i]['foreign_pk_access'] = $foreign_access;
			}
		  }
		  return $array['data'];
		}
		return NULL;	
	}

}

?>