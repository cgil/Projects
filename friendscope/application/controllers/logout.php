<?php

class Logout extends CI_Controller {
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
	
	//Log user out, destroy their session, redirect to login
	function index(){
		try{
			$fbme = $this->facebook->api('/me');
		} catch (FacebookApiException $e){
				error_log($e);
		}
		
		if($fbme){
			$auth_config['next'] = base_url();
			$logoutUrl = $this->facebook->getLogoutUrl($auth_config);
			$this->session->sess_destroy();
			redirect($logoutUrl, 'refresh');
		}
	}
}

?>