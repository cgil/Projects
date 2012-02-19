<?php
/*	Display help information
 */
 
class Help extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->write_view('header', 'header', "", TRUE);
		$this->template->write_view('search', 'search', "", TRUE);
		$this->template->write_view('albums', 'help', "", TRUE);
		$this->template->write_view('footer', 'footer', "", TRUE);
		
		$this->template->render();
	}
	
}