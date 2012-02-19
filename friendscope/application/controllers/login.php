<?php

class Login extends CI_Controller {

    function index() {

        //Enter your Application Id and Application Secret keys
        $config['appId'] = '';
        $config['secret'] = '';

        //Do you want cookies enabled?
        $config['cookie'] = true;
        
        //load Facebook php-sdk library with $config[] options
        $this->load->library('facebook', $config);

        //Load Session class for saving access token later
        // auto loaded: $this->load->library('session');

        //Check to see if there is an active Facebook session.
        //We will not know if the session is valid until the call is made
        $session = $this->facebook->getSession();
        
        //Check to see if the access_token is present in Facebook session data
        if (!empty($session['access_token'])) {

            //Save token to Session data for later use
            $this->session->set_userdata('access_token', $session['access_token']);
			
			//Redirect to update access token
			$base_url = base_url();
			header('Location: ' . $base_url . 'access_db/Store_access_token/');

        } else {

            //Extended Permissions requested from the API at time of login
            $auth_config['req_perms'] = 'read_friendlists,offline_access,user_photos,friends_photos,user_about_me,friends_about_me';

            //Dialog Form Factors used to display login page
            $auth_config['display'] = 'popup';

            //Callback URL once user is authenticated
            $auth_config['next'] = 'http://www.nodefy.com/CodeIgniter/access_db/Store_access_token/';

            //Get the login URL using the parameters in $auth_config array
            $login_url = $this->facebook->getLoginUrl($auth_config);
			//Authorize login through facebook then redirect back to friendscope
            header('Location: ' . $login_url);
        }
		
        //This is where you will make your all your calls

        //Example call using POST
        //$params['message'] = 'Testing Facebook php-sdk with Codeigniter';
        //$this->facebook->api('/tbrandonbeasley/feed', 'POST', $params);

        //Example call listing friends of active user using GET (default)
        //$data['api_info']    = $this->facebook->api('/me/friends');
        
        //Get the logout URL
        //$data['logout_url'] = $this->facebook->getLogoutUrl();

        //Load view to display results of API calls
        //$this->load->view('example', $data);
    }
		
}

