<?php
/*	Scope of a single persons profile
 *	Include: profile picture, albums, and all other pictures
 */
 
class Scope extends CI_Controller{
	
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
	
	//Load main view to display data
	function index(){
		$this->template->write_view('header', 'header', "", TRUE);
		$this->template->write_view('search', 'search', "", TRUE);
		$this->template->write_view('footer', 'footer', "", TRUE);
		
		$this->form_validation->set_rules('user_id', 'UserID',
			 'trim|required|min_length[1]|max_length[20]');
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->template->render();
		}
		else
		{
			//Get all the albums for entered user_id
			$target_uid = $this->input->post('user_id');
			$data['all_albums']= $this->Get_albums($target_uid);
			if($data['all_albums'] != NULL){
				//Render the albums section with new albums
				$data['target_name'] = $this->Get_target_name($target_uid);
				$this->template->write_view('info', 'info', $data, TRUE);
				$this->template->write_view('albums', 'albums', $data, TRUE);
			}
			
			if(isset($target_uid) && !is_numeric($target_uid)){
				//Check if the user entered a targets name and display sidebar
				$data['friends_query'] = $this->Get_similar_friends($target_uid);
				if(!is_null($data['friends_query'])){
					$this->template->write_view('friendbar', 'friendbar', $data, TRUE);
				}
			}
			$this->template->render();
		}
	}
	
	//Get all albums store it in data['all_albums']
	function Get_albums($entered_uid){
		$target_uid = $this->Get_real_uid($entered_uid);
		if(is_null($target_uid)){
			return NULL;	
		}
		//Get an access token that can view the target user id
		$access_tokens = $this->Find_access_token($target_uid);
		$data['all_albums'] = NULL;	
		if(!is_null($access_tokens)){
			//Try every access token until one works
			foreach($access_tokens as $token){
				$access_token = $token[0];
				$origin_pk_id = $token[1];
				try{
					//Call Facebook Api with given access token
					$params['access_token'] = $access_token;
					$albums = $this->facebook->api('/'.$target_uid .
						'/albums','GET',$params);
					if(!array_key_exists('error',$albums)){
						//Found a working access token and retrieved albums
						break;	
					}
					else{
						//Unset this broken access token for this target
						$this->Scope_model->unset_target($target_uid,$origin_pk_id);	
					}
				} catch (FacebookApiException $e){
					error_log($e);
					echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
					
				}
			}
			//Store album information in album array
			$album_arr = array();
			if(isset($albums['data'])){
				foreach($albums['data'] as $item){
					//Get cover photo for each album
					$album_picture = 'https://graph.facebook.com/'.$item['id'].
						'/picture?access_token='.
						$access_token.'&type=album';

					//Prepare data
					if(!isset($item['name']))
						$item['name'] = "picture";
					if(!isset($item['cover_photo']))
						$item['cover_photo'] = "";
					if(!isset($item['link']))
						$item['link'] = "";	
					if(!isset($item['count']))
						$item['count'] = 0;
					if(!isset($item['id']))
						$item['id'] = "0";
						
					//Create album data array
					$album_info = array($item['name'],$item['cover_photo'],$item['link'],
						$item['count'],$item['id'],$album_picture);
					$album_arr[] = $album_info;
					unset($album_picture);
				}
			}
			$data['all_albums'] = $album_arr;
			//Store working access token in session
			$newdata = array(
                   'album_token'  => $access_token,
               );
			$this->session->set_userdata($newdata);
			return $data['all_albums'];
		}
	}
	
	//Get all photos within an album store it in data['album_photos']
	function Get_album_photos($albumID,$access_token){
		try{
			$params['access_token'] = $access_token;
			$params['limit'] = 100;
			$photos = $this->facebook->api('/'.$albumID.'/photos','GET',$params);
		} catch (FacebookApiException $e){
			error_log($e);
			echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
			$data['album_photos'] = NULL;
			
		}
		if(isset($photos['data'])){
			$data['album_photos'] = $photos['data'];
		}
		else{
			$data['album_photos'] = NULL;	
		}

		//Echo back the photos view
		$this->template->write_view('photos', 'photos', $data, TRUE);
		$photos = $this->template->render('photos');
		echo $photos;

	}
	
	//Query database looking for match on target user id and return access token to it
	function Find_access_token($target_uid){
		$this->load->model('Scope_model');
		return $this->Scope_model->query_uid($target_uid);	
	}
	
	//Get the targets name credentials
	function Get_target_name($target_uid){
		try{
				$target_info = $this->facebook->api('/'.$target_uid);
			} catch (FacebookApiException $e){
				error_log($e);
				echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
				return NULL;	
			}
			
			if(isset($target_info['name'])){
				return $target_info['name'];
			}
			else{
				return NULL;	
			}
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
	
	//Get names of people in database with a similar name
	function Get_similar_friends($target_name){
		$this->load->model('Scope_model');
		$target_list = $this->Scope_model->find_similar_friends($target_name);
		if(!is_null($target_list)){
			return $target_list;
		}
		else{
			return NULL;	
		}
	}
	
	//Wrapper for Get_albums to use with ajax 
	function Get_albums_by_ajax($entered_uid){
		$data['all_albums'] = $this->Get_albums($entered_uid);
		$this->template->write_view('albums', 'albums', $data, TRUE);
		$albums_view = $this->template->render('albums');
		echo $albums_view;
	}
	
}







?>