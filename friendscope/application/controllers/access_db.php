<?php
/*	Query the database
 */
 
class Access_db extends CI_Controller{
	//Check if an access token exists in the database, store it if it does not
	function Store_access_token(){
		//Enter your Application Id and Application Secret keys
        $config['appId'] = '';
        $config['secret'] = '';

        //Do you want cookies enabled?
        $config['cookie'] = true;
		//load Facebook php-sdk library with $config[] options
		$this->load->library('facebook', $config);
		
		$access_token = $this->facebook->getAccessToken();
		
		//Query db and store access token if unique
		$this->load->model('Store_access_token_model');
		$this->Store_access_token_model->store_access_tok($access_token);
		
		//Redirect to home page
		redirect('/scope/','refresh');
	}
	 
	 
}



?>